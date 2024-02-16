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
            $this->_payService->addSubscriptionForUser($request, true);
        }
    }
    public function payboxSuccessURL(Request $request)
    {
        if ($this->getResult($request)) {
            $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?success=1' : 'https://xn--80a4d.kz/dashboard/plan-mode?success=1';
        } else {
            $link = "https://xn--80a4d.kz/dashboard/plan-mode?error=1";
        }
        return redirect($link);
    }
    public function payboxFailureURL(Request $request)
    {
//        return redirect('https://xn--80a4d.kz/dashboard/plan-mode?error=1');
        return redirect('http://localhost:4200/dashboard/my-profile?error=1');
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
    public function payCareer(Request $request) {
        try {
            $this->validate($request, [
                'career_quiz_id' => 'sometimes|nullable|exists:career_quizzes,id',
                'career_group_id' => 'sometimes|nullable|exists:career_quiz_groups,id'
            ]);
            return $this->_payService->initialCareerPay($request);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function payboxCareerResultURL(Request $request)
    {
        if ($request['pg_result'] == 1) {
            $this->_payService->addAcceptForUser($request);
        }
    }
    public function payboxCareerSuccessURL(Request $request)
    {
        $response = $this->_payService->getResultStatus($request);
        $content = json_decode($response->content(), true);
        if ($content['pg_status'] == 'ok') {
            if ($content['pg_payment_status'] == 'success') {
                $this->_payService->addAcceptForUser($request);
                return redirect('http://localhost:4200/dashboard/my-profile?success=1');
            } else {
                return redirect('https://xn--80a4d.kz/dashboard/plan-mode?error=1');
            }
        } else {
            return redirect('https://xn--80a4d.kz/dashboard/plan-mode?error=1');
        }
    }
    public function payboxCareerFailureURL(Request $request)
    {
//        return redirect('https://xn--80a4d.kz/dashboard/plan-mode?error=1');
        return redirect('http://localhost:4200/dashboard/my-profile?error=1');
    }
}
