<?php

namespace App\Http\Controllers\Api;

use App\Events\BattleDetailEvent;
use App\Http\Controllers\Controller;
use App\Models\Battle;
use App\Models\BattleBet;
use App\Models\User;
use App\Services\AttemptService;
use App\Services\BattleService;
use App\Services\QuestionService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;


class TestController extends Controller
{
    private QuestionService $_questionService;
    private AttemptService $_attemptService;
    private BattleService $_battleService;
    public function __construct(QuestionService $questionService,AttemptService $attemptService,BattleService $battleService)
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
        $this->_battleService = $battleService;
    }



    public function test(Request $request)
    {
        return response()->json("Hello world!");
    }

    public function paybox(Request $request)
    {
        $pg_merchant_id = '544907';
        $secret_key = 'GDAIXZ43xI5BzDiJ';

        $request = $requestForSignature = [
            'pg_order_id' => '11',
            'pg_merchant_id' => $pg_merchant_id,
            'pg_amount' => '25',
            'pg_description' => 'test',
            'pg_salt' => 'molbulak',
            'pg_payment_route' => 'frame',
            'pg_currency' => 'KZT',
            'pg_check_url' => 'http://localhost:4200/pay/check',
            'pg_result_url' => 'http://localhost:4200/pay/result',
            'pg_request_method' => 'POST',
            'pg_success_url' => 'http://localhost:4200/pay/success',
            'pg_failure_url' => 'http://localhost:4200/pay/failure',
            'pg_success_url_method' => 'GET',
            'pg_failure_url_method' => 'GET',
            'pg_payment_system' => 'EPAYWEBKZT',
            'pg_lifetime' => '86400',
            'pg_postpone_payment' => '0',
            'pg_language' => 'ru',
            'pg_testing_mode' => '1',
            'pg_recurring_start' => '1',
            'pg_recurring_lifetime' => '156',
            'pg_user_id' => '1'
        ];

        /**
         * Функция превращает многомерный массив в плоский
         */

        // Превращаем объект запроса в плоский массив
        $requestForSignature = $this->makeFlatParamsArray($requestForSignature);

        // Генерация подписи
        ksort($requestForSignature); // Сортировка по ключю
        array_unshift($requestForSignature, 'init_payment.php'); // Добавление в начало имени скрипта
        array_push($requestForSignature, $secret_key); // Добавление в конец секретного ключа

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
