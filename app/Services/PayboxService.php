<?php

namespace App\Services;

use App\Models\PayboxOrder;
use App\Traits\ResponseJSON;
use Bpuig\Subby\Models\Plan;
use Illuminate\Support\Str;

class PayboxService
{
    public function initialPay($request): \Illuminate\Http\JsonResponse
    {
        $PG_MERCHANT_ID = env('PG_MERCHANT_ID');
        $PG_SECRET_KEY = env('PG_SECRET_KEY');
        $subjects = [1, 2, 3, intval($request['subject_first']), intval($request['subject_second'])];
        $order_id = strval(rand(0, 999999));
        $plans = [];
        foreach ($subjects as $subject) {
            $plan = Plan::where('tag', $this->getPlanTag($subject, $request['time']))->first();
            $plans[] = $plan->id;
        }
        PayboxOrder::where('order_id', $order_id)->firstOrCreate([
            'order_id' => $order_id,
            'price' => $this->getSum($request['time']),
            'user_id' => auth()->guard('api')->id(),
            'subjects' => $subjects,
            'plans' => $plans,
            'status' => 0
        ]);

        $request = $requestForSignature = [
            'pg_order_id' => $order_id,
            'pg_merchant_id' => $PG_MERCHANT_ID,
            'pg_amount' => $this->getSum($request['time']),
            'pg_description' => $this->getDescription($request['time']),
            'pg_salt' => Str::random(10),
            'pg_payment_route' => 'frame',
            'pg_currency' => 'KZT',
            'pg_check_url' => '',
            'pg_result_url' => 'https://back.xn--80a4d.kz/api/pay/result',
            'pg_request_method' => 'POST',
            'pg_success_url' => 'http://localhost:8000/api/pay/success',
            'pg_failure_url' => 'http://localhost:8000/api/pay/failure',
            'pg_success_url_method' => 'POST',
            'pg_failure_url_method' => 'POST',
            'pg_payment_system' => 'EPAYWEBKZT',
            'pg_lifetime' => '86400',
            'pg_postpone_payment' => '0',
            'pg_language' => 'ru',
            'pg_testing_mode' => '1',
            'pg_recurring_start' => '1',
            'pg_recurring_lifetime' => '156',
            'pg_user_id' => strval(auth()->guard('api')->id()),
            'pg_param1' => auth()->guard('api')->id(),
            'xutokupu' => '11'
        ];

        /**
         * Функция превращает многомерный массив в плоский
         */

        // Превращаем объект запроса в плоский массив
        $requestForSignature = $this->makeFlatParamsArray($requestForSignature);

        // Генерация подписи
        ksort($requestForSignature); // Сортировка по ключю
        array_unshift($requestForSignature, 'init_payment.php'); // Добавление в начало имени скрипта
        array_push($requestForSignature, $PG_SECRET_KEY); // Добавление в конец секретного ключа

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
        $array = json_decode($json,TRUE);
        if ($err) {
            return response()->json($err);
        } else {
            return response()->json(new ResponseJSON(status: true, data: $array));
        }
    }
    public function getPlanTag($subjectID, $time): string
    {
        return $subjectID.'.'.$time;
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
            3 => 'Тариф Стандарт',
            6 => 'Тариф Премиум',
            default => 'Тариф Базовый'
        };
    }
    public function getResultStatus($req)
    {
        $PG_MERCHANT_ID = env('PG_MERCHANT_ID');
        $PG_SECRET_KEY = env('PG_SECRET_KEY');

        $request = [
            'pg_merchant_id'=> $PG_MERCHANT_ID,
            'pg_payment_id' => intval($req['pg_payment_id']),
            'pg_salt' => Str::random(10)
        ];

        //generate a signature and add it to the array
        ksort($request); //sort alphabetically
        array_unshift($request, 'get_status3.php');
        array_push($request, $PG_SECRET_KEY);
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
        $array = json_decode($json,TRUE);
        if ($err) {
            return response()->json($err);
        } else {
            return response()->json($array);
        }
    }
    public function makeFlatParamsArray($arrParams, $parent_name = '')
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
