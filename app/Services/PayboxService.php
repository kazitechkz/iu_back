<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Models\CareerCoupon;
use App\Models\CareerQuiz;
use App\Models\CareerQuizGroup;
use App\Models\PayboxOrder;
use App\Models\Tournament;
use App\Models\TournamentOrder;
use App\Models\User;
use App\Traits\ResponseJSON;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PayboxService
{
    //Pay
    public function initialPay($request): \Illuminate\Http\JsonResponse
    {
        $subjects = [1, 2, 3, intval($request['subject_first']), intval($request['subject_second'])];
        $order_id = strval(rand(0, 999999999));
        $user = auth()->guard('api')->user();
        if (PayboxOrder::where('order_id', $order_id)->first()) {
            $order_id = strval(rand(0, 999999999));
        }
        $plans = [];
        foreach ($subjects as $subject) {
            $plan = Plan::where('tag', $this->getPlanTag($subject, $request['time']))->first();
            $plans[] = $plan->id;
        }
        PayboxOrder::where('order_id', $order_id)->create([
            'order_id' => $order_id,
            'price' => $this->getSum($request['time']),
            'description' => $user->isKundelik() ? $this->getDescription($request['time']).'.'.$this->TRANSACTION_CODES[0] : $this->getDescription($request['time']),
            'user_id' => auth()->guard('api')->id(),
            'subjects' => $subjects,
            'plans' => $plans,
            'status' => 0
        ]);
        $request = $requestForSignature = [
            'pg_order_id' => $order_id,
            'pg_merchant_id' => $this->getSecretKey()['PG_MERCHANT_ID'],
            'pg_amount' => $this->getSum($request['time']),
            'pg_description' => $this->getDescription($request['time']),
            'pg_salt' => Str::random(10),
            'pg_payment_route' => 'frame',
            'pg_currency' => 'KZT',
            'pg_check_url' => '',
            'pg_result_url' => $this->getRedirectURL()['payResultURL'],
            'pg_request_method' => 'POST',
            'pg_success_url' => $this->getRedirectURL()['paySuccessURL'],
            'pg_failure_url' => $this->getRedirectURL()['payFailureURL'],
            'pg_success_url_method' => 'POST',
            'pg_failure_url_method' => 'POST',
            'pg_payment_system' => 'EPAYWEBKZT',
            'pg_lifetime' => '86400',
            'pg_postpone_payment' => '0',
            'pg_language' => 'ru',
            'pg_testing_mode' => '1',
            'pg_recurring_start' => '1',
            'pg_recurring_lifetime' => '156',
            'pg_user_id' => strval(auth()->guard('api')->id())
        ];
        return $this->getInitPay($request, $requestForSignature);
    }
    public function getPlanTag($subjectID, $time): string
    {
        return $subjectID . '.' . $time;
    }
    public function getSum($time): int
    {
        return match ($time) {
            3 => 2490,
            6 => 4990,
            default => 990,
        };
    }
    public function getDescription($time): string
    {
        return match ($time) {
            3 => $this->TRANSACTION_CODES[2],
            6 => $this->TRANSACTION_CODES[3],
            default => $this->TRANSACTION_CODES[1]
        };
    }
    public function addSubscriptionForUser(Request $request, bool $cashback = false): void
    {
        $order = PayboxOrder::where('order_id', $request['pg_order_id'])->first();
        if ($order) {
            $cash = intval($order->price*0.1);
            $user = User::find($order->user_id);
            $order->status = 1;
            $order->save();
            foreach ($order->plans as $item) {
                $plan = Plan::find($item);
                if (PlanSubscription::where(["subscriber_id" => $order->user_id, "plan_id" => $plan->id])->first()) {
                    // Check subscriber to plan
                    if (!$user->isSubscribedTo($plan->id)) {
                        $user->subscription($plan->tag)->renew();
                    }
                } else {
                    $user->newSubscription(
                        $plan->tag, // identifier tag of the subscription. If your application offers a single subscription, you might call this 'main' or 'primary'
                        $plan, // Plan or PlanCombination instance your subscriber is subscribing to
                        $plan->name, // Human-readable name for your subscription
                        $plan->description // Description
                    );
                }
            }
            if ($cashback) {
                $user->deposit($cash);
            }
        }
    }

    //Career Pay
    public function initialCareerPay($request): \Illuminate\Http\JsonResponse
    {
        $order_id = strval(rand(0, 999999999));
        $user = auth()->guard("api")->user();
        $description = $user->isKundelik() ? $this->TRANSACTION_CODES[4].'.'.$this->TRANSACTION_CODES[0] : $this->TRANSACTION_CODES[4];
        if (CareerCoupon::where('order_id', $order_id)->first()) {
            $order_id = strval(rand(0, 999999999));
        }
        $row = $request->all();
        if ($request->has('career_group_id')) {
            $quizzes = CareerQuiz::where('group_id', $request['career_group_id'])->get();
            $price = (CareerQuizGroup::find($row["career_group_id"]))->price;
            $raw_data = [];
            foreach ($quizzes as $quiz) {
                $raw_data[] = [
                    'user_id' => $user->id,
                    'order_id' => $order_id,
                    'career_quiz_id' => $quiz->id,
                    'career_group_id' => $quiz->group_id,
                    'is_used' => true,
                    'status' => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            CareerCoupon::insert($raw_data);
        } elseif ($request->has("career_quiz_id")) {
            $quiz = CareerQuiz::find($row["career_quiz_id"]);
            $price = $quiz->price;
            CareerCoupon::create([
                'user_id' => $user->id,
                'order_id' => $order_id,
                'career_quiz_id' => $quiz->id,
                'career_group_id' => $quiz->group_id,
                'is_used' => true,
                'status' => false
            ]);
        } else {
            throw new BadRequestException("Вы не выбрали ни один из продуктов!");
        }
        $request = $requestForSignature = [
            'pg_order_id' => $order_id,
            'pg_merchant_id' => $this->getSecretKey()['PG_MERCHANT_ID'],
            'pg_amount' => $price,
            'pg_description' => $description,
            'pg_salt' => Str::random(10),
            'pg_payment_route' => 'frame',
            'pg_currency' => 'KZT',
            'pg_check_url' => '',
            'pg_result_url' => $this->getRedirectURL()['payCareerResultURL'],
            'pg_request_method' => 'POST',
            'pg_success_url' => $this->getRedirectURL()['payCareerSuccessURL'],
            'pg_failure_url' => $this->getRedirectURL()['payCareerFailureURL'],
            'pg_success_url_method' => 'POST',
            'pg_failure_url_method' => 'POST',
            'pg_payment_system' => 'EPAYWEBKZT',
            'pg_lifetime' => '86400',
            'pg_postpone_payment' => '0',
            'pg_language' => 'ru',
            'pg_testing_mode' => '1',
            'pg_recurring_start' => '1',
            'pg_recurring_lifetime' => '156',
            'pg_user_id' => strval(auth()->guard('api')->id())
        ];
        return $this->getInitPay($request, $requestForSignature);
    }
    public function addAcceptForUser(Request $request): void
    {
        $coupons = CareerCoupon::where('order_id', $request['pg_order_id'])->get();
        if ($coupons) {
            foreach ($coupons as $coupon) {
                $coupon->status = true;
                $coupon->is_used = false;
                $coupon->save();
            }
        }
    }

    //Tournament Pay
    public function initialTournamentPay($request): \Illuminate\Http\JsonResponse
    {
        $order_id = strval(rand(0, 999999999));
        $user = auth()->guard("api")->user();
        $description = $user->isKundelik() ? $this->TRANSACTION_CODES[5].'.'.$this->TRANSACTION_CODES[0] : $this->TRANSACTION_CODES[5];
        if (TournamentOrder::where('order_id', $order_id)->first()) {
            $order_id = strval(rand(0, 999999999));
        }
        if ($request->has('tournament_id')) {
            $tournament = Tournament::find($request['tournament_id']);
            TournamentOrder::create([
                'user_id' => $user->id,
                'order_id' => $order_id,
                'price' => $tournament->price,
                'description' => $description,
                'tournament_id' => $tournament->id,
                'status' => false
            ]);
            $request = $requestForSignature = [
                'pg_order_id' => $order_id,
                'pg_merchant_id' => $this->getSecretKey()['PG_MERCHANT_ID'],
                'pg_amount' => $tournament->price,
                'pg_description' => $description,
                'pg_salt' => Str::random(10),
                'pg_payment_route' => 'frame',
                'pg_currency' => 'KZT',
                'pg_check_url' => '',
                'pg_result_url' => $this->getRedirectURL()['payTournamentResultURL'],
                'pg_request_method' => 'POST',
                'pg_success_url' => $this->getRedirectURL()['payTournamentSuccessURL'],
                'pg_failure_url' => $this->getRedirectURL()['payTournamentFailureURL'],
                'pg_success_url_method' => 'POST',
                'pg_failure_url_method' => 'POST',
                'pg_payment_system' => 'EPAYWEBKZT',
                'pg_lifetime' => '86400',
                'pg_postpone_payment' => '0',
                'pg_language' => 'ru',
                'pg_testing_mode' => '1',
                'pg_recurring_start' => '1',
                'pg_recurring_lifetime' => '156',
                'pg_user_id' => strval(auth()->guard('api')->id())
            ];
            return $this->getInitPay($request, $requestForSignature);
        } else {
            throw new BadRequestException("Вы не выбрали ни один из продуктов!");
        }
    }
    public function addTournamentOrder(Request $request): void
    {
        $tournamentOrder = TournamentOrder::where('order_id', $request['pg_order_id'])->first();
        if ($tournamentOrder) {
            $tournamentOrder->status = true;
            $tournamentOrder->save();
        }
    }
    //CORE
    public $TRANSACTION_CODES = [
        0 => "KUNDELIK.KZ",
        1 => "Базовый тариф",
        2 => "Стандартный тариф",
        3 => "Премиум тариф",
        4 => "Профориентация",
        5 => "Турнир"
    ];
    public function getResultStatus($req): \Illuminate\Http\JsonResponse
    {
        $request = [
            'pg_merchant_id' => $this->getSecretKey()['PG_MERCHANT_ID'],
            'pg_payment_id' => intval($req['pg_payment_id']),
            'pg_salt' => Str::random(10)
        ];
        //generate a signature and add it to the array
        ksort($request); //sort alphabetically
        array_unshift($request, 'get_status3.php');
        array_push($request, $this->getSecretKey()['PG_SECRET_KEY']);
        $request['pg_sig'] = md5(implode(';', $request)); // signature
        unset($request[0], $request[1]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.freedompay.money/get_status3.php",// your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        if ($err) {
            return response()->json($err);
        } else {
            return response()->json($array);
        }
    }
    private function getSecretKey(): array
    {
        $data['PG_MERCHANT_ID'] = env('PG_MERCHANT_ID');
        $data['PG_SECRET_KEY'] = env('PG_SECRET_KEY');
        return $data;
    }
    public function getRedirectURL(): array
    {
        $data['payResultURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/result' : 'https://back.xn--80a4d.kz/api/pay/result';
        $data['paySuccessURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/success' : 'https://back.xn--80a4d.kz/api/pay/success';
        $data['payFailureURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/failure' : 'https://back.xn--80a4d.kz/api/pay/failure';
        $data['payCareerResultURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/career-result' : 'https://back.xn--80a4d.kz/api/pay/career-result';
        $data['payCareerSuccessURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/career-success' : 'https://back.xn--80a4d.kz/api/pay/career-success';
        $data['payCareerFailureURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/career-failure' : 'https://back.xn--80a4d.kz/api/pay/career-failure';
        $data['payTournamentResultURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/tournament-result' : 'https://back.xn--80a4d.kz/api/pay/tournament-result';
        $data['payTournamentSuccessURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/tournament-success' : 'https://back.xn--80a4d.kz/api/pay/tournament-success';
        $data['payTournamentFailureURL'] = env('APP_DEBUG') ? 'http://localhost:8000/api/pay/tournament-failure' : 'https://back.xn--80a4d.kz/api/pay/tournament-failure';
        return $data;
    }
    private function getInitPay($request, $requestForSignature): \Illuminate\Http\JsonResponse
    {
        /**
         * Функция превращает многомерный массив в плоский
         */

        // Превращаем объект запроса в плоский массив
        $requestForSignature = $this->makeFlatParamsArray($requestForSignature);
        // Генерация подписи
        ksort($requestForSignature); // Сортировка по ключю
        array_unshift($requestForSignature, 'init_payment.php'); // Добавление в начало имени скрипта
        array_push($requestForSignature, $this->getSecretKey()['PG_SECRET_KEY']); // Добавление в конец секретного ключа
        $request['pg_sig'] = md5(implode(';', $requestForSignature)); // Полученная подпись
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.freedompay.money/init_payment.php",// your preferred url
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        if ($err) {
            return response()->json($err);
        } else {
            return response()->json(new ResponseJSON(status: true, data: $array));
        }
    }
    public function makeFlatParamsArray($arrParams, $parent_name = ''): array
    {
        $arrFlatParams = [];
        $i = 0;
        foreach ($arrParams as $key => $val) {
            $i++;
            /**
             * Имя делаем вида tag001subtag001
             * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
             */
            $name = $parent_name . $key . sprintf('%03d', $i);
            if (is_array($val)) {
                $arrFlatParams = array_merge($arrFlatParams, $this->makeFlatParamsArray($val, $name));
                continue;
            }
            $arrFlatParams += array($name => (string)$val);
        }

        return $arrFlatParams;
    }
}
