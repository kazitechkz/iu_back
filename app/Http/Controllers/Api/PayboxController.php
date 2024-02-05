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
            $order = PayboxOrder::where('order_id', $request['pg_order_id'])->first();
            if ($order) {
                $user = User::find($order->user_id);
                $order->description = $request['pg_description'];
                $order->status = 1;
                $order->save();
                foreach ($order->plans as $item) {
                    $plan = Plan::find($item);
                    if(PlanSubscription::where(["subscriber_id"=>$order->user_id,"plan_id"=>$plan->id])->first()){
                        // Check subscriber to plan
                        if(!$user->isSubscribedTo($plan->id))
                        {
                            $user->subscription($plan->tag)->renew();
                        }
                    }
                    else{
                        $user->newSubscription(
                            $plan->tag, // identifier tag of the subscription. If your application offers a single subscription, you might call this 'main' or 'primary'
                            $plan, // Plan or PlanCombination instance your subscriber is subscribing to
                            $plan->name, // Human-readable name for your subscription
                            $plan->description // Description
                        );
                    }
                }
            }
        }
    }
    public function payboxResultSuccess(Request $request)
    {
        if ($this->getResult($request)) {
            $link = "https://xn--80a4d.kz/dashboard/plan-mode?success=1";
        } else {
            $link = "https://xn--80a4d.kz/dashboard/plan-mode?error=1";
        }
        return redirect($link);
    }

    public function payboxResultFailure(Request $request)
    {
        return redirect('https://xn--80a4d.kz/dashboard/plan-mode?error=1');
    }

    public function getResult(Request $request)
    {
        $response = $this->_payService->getResultStatus($request);
        $content = json_decode($response->content(), true);
        if ($content['pg_status'] == 'ok') {
            return true;
        } else {
            return false;
        }
    }
}
