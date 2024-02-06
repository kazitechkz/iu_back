<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PayboxOrder;
use App\Models\User;
use App\Services\PayboxService;
use App\Services\ResponseService;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Http\Request;

class PayboxController extends Controller
{
    private PayboxService $_payService;

    public function __construct(PayboxService $payService)
    {
        $this->_payService = $payService;
    }

    public function paybox(Request $request)
    {
        try {
            $this->validate($request, [
                'subject_first' => 'required|exists:subjects,id',
                'subject_second' => 'required|exists:subjects,id',
                'time' => 'required'
            ]);
            return $this->_payService->initialPay($request);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function payboxResultURL(Request $request)
    {
        if ($request['pg_result'] == 1) {
            $this->_payService->addSubscriptionForUser($request);
        }
    }

    public function payboxSuccessURL(Request $request)
    {
        if ($this->getResult($request)) {
            $link = "https://xn--80a4d.kz/dashboard/plan-mode?success=1";
//            $link = "http://localhost:4200/dashboard/plan-mode?success=1";
        } else {
            $link = "https://xn--80a4d.kz/dashboard/plan-mode?error=1";
        }
        return redirect($link);
    }

    public function payboxFailureURL(Request $request)
    {
        return redirect('https://xn--80a4d.kz/dashboard/plan-mode?error=1');
//        return redirect('http://localhost:4200/dashboard/plan-mode?error=1');
    }

    public function getResult(Request $request)
    {
        $response = $this->_payService->getResultStatus($request);
        $content = json_decode($response->content(), true);
        if ($content['pg_status'] == 'ok') {
            if ($content['pg_payment_status'] == 'success') {
                $this->_payService->addSubscriptionForUser($request);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
