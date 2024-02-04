<?php

namespace App\Http\Controllers\Api;

use App\Events\BattleDetailEvent;
use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Battle;
use App\Models\BattleBet;
use App\Models\PayboxOrder;
use App\Models\User;
use App\Services\AttemptService;
use App\Services\BattleService;
use App\Services\PayboxService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Carbon\Carbon;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;


class TestController extends Controller
{
    private QuestionService $_questionService;
    private AttemptService $_attemptService;
    private BattleService $_battleService;
    private PayboxService $_payService;
    public function __construct(QuestionService $questionService,AttemptService $attemptService,BattleService $battleService, PayboxService $payService)
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
        $this->_payService = $payService;
        $this->_battleService = $battleService;
    }



    public function test(Request $request)
    {
        return response()->json("Hello world!");
    }

    public function sendWhatsapp()
    {

        $user = User::with(['attempts' => function ($query) {
            $query->where('type_id',1)->whereBetween('created_at', [Carbon::now()->startOfDay()->subMonth(), Carbon::now()->endOfDay()])
                ->with('attempt_subjects');
//            $query->where('type_id',1)->whereBetween('created_at', [Carbon::now()->startOfDay()->subWeek(), Carbon::now()->endOfDay()]);
        }])->findOrFail(32);
        if ($user->attempts) {
            $data[$user->name]['parent_name'] = $user->parent_name ? $user->parent_name : 'Mother';
            $data[$user->name]['total_count'] = $user->attempts->count();
            $data[$user->name]['average_score'] = $user->attempts->sum('points')/$user->attempts->count();
            foreach ($user->attempts as $attempt) {
                foreach ($attempt->attempt_subjects as $attempt_subject) {
                    $data[$user->name]['subjects'][$attempt_subject->attempt_id][] = $attempt_subject->subject_id;
                }
            }
        }
        return response()->json(['data' => $data]);
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
        $desc = $this->getResult($request);
        $link = "https://xn--80a4d.kz/dashboard/plan-mode?success=1&desc=".$desc;
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
            $order = PayboxOrder::where('order_id', $request['pg_order_id'])->first();
            if ($order->status == 1) {
                return $order->description;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getResultForSuccessURL(Request $request)
    {
        $response = $this->_payService->getResultStatus($request);
        $content = json_decode($response->content(), true);
        if ($content['pg_status'] == 'ok' && $content['pg_payment_status'] == 'success') {
            $order = PayboxOrder::where('order_id', $request['pg_order_id'])->first();
            if ($order) {
                $user = User::find($order->user_id);
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
            } else {
                abort(500, 'Неизвестная ошибка');
            }
        } else {
            throw new \Exception('Неизвестная ошибка');
        }
    }
}
