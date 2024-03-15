<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TournamentException;
use App\Http\Controllers\Controller;
use App\Models\PayboxOrder;
use App\Models\SubTournament;
use App\Models\TournamentOrder;
use App\Models\User;
use App\Services\PayboxService;
use App\Services\ResponseService;
use App\Services\TournamentService;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Http\Request;

class PayboxController extends Controller
{
    private PayboxService $_payService;
    private TournamentService $_tournamentService;

    public function __construct(PayboxService $payService, TournamentService $tournamentService)
    {
        $this->_payService = $payService;
        $this->_tournamentService = $tournamentService;
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
            $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?success=1' : 'https://iutest.kz/dashboard/my-profile?success=1';
        } else {
            $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?error=1' : 'https://iutest.kz/dashboard/my-profile?error=1';
        }
        return redirect($link);
    }
    public function payboxFailureURL(Request $request)
    {
        $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?error=1' : 'https://iutest.kz/dashboard/my-profile?error=1';
        return redirect($link);
    }
    public function getResult(Request $request)
    {
        $user = $this->_payService->getUserFromOrderID($request['pg_order_id']);
        $response = $this->_payService->getResultStatus($request, $user);
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
        $user = $this->_payService->getUserFromOrderID($request['pg_order_id'],2);
        $response = $this->_payService->getResultStatus($request, $user);
        $content = json_decode($response->content(), true);
        if ($content['pg_status'] == 'ok') {
            if ($content['pg_payment_status'] == 'success') {
                $this->_payService->addAcceptForUser($request);
                $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?success=1' : 'https://iutest.kz/dashboard/my-profile?success=1';
            } else {
                $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?error=1' : 'https://iutest.kz/dashboard/my-profile?error=1';
            }
        } else {
            $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?error=1' : 'https://iutest.kz/dashboard/my-profile?error=1';
        }
        return redirect($link);
    }
    public function payboxCareerFailureURL(Request $request)
    {
        $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?error=1' : 'https://iutest.kz/dashboard/my-profile?error=1';
        return redirect($link);
    }
    public function payTournament(Request $request) {
        try {
            $this->validate($request, [
                'sub_tournament_id' => 'required|exists:sub_tournaments,id',
                'locale_id' => 'required|exists:locales,id'
            ]);
            return $this->_payService->initialTournamentPay($request);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    /**
     * @throws TournamentException
     */
    public function payTournamentResultURL(Request $request)
    {
        if ($request['pg_result'] == 1) {
            $this->_payService->addTournamentOrder($request, $this->_tournamentService);
        }
    }

    /**
     * @throws TournamentException
     */
    public function payTournamentSuccessURL(Request $request)
    {
        $user = $this->_payService->getUserFromOrderID($request['pg_order_id'],3);
        $response = $this->_payService->getResultStatus($request, $user);
        $content = json_decode($response->content(), true);
        if ($content['pg_status'] == 'ok') {
            if ($content['pg_payment_status'] == 'success') {
                $id = $this->_payService->addTournamentOrder($request, $this->_tournamentService, true);
                $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/tournament-detail/'.$id.'?success=1' : 'https://iutest.kz/dashboard/tournament-detail/'.$id.'?success=1';
            } else {
                $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?error=1' : 'https://iutest.kz/dashboard/my-profile?error=1';
            }
        } else {
            $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/my-profile?error=1' : 'https://iutest.kz/dashboard/my-profile?error=1';
        }
        return redirect($link);
    }
    public function payTournamentFailureURL(Request $request)
    {
        $tournamentOrder = TournamentOrder::where('order_id', $request['pg_order_id'])->first();
        if ($tournamentOrder) {
            $id = (SubTournament::find($tournamentOrder->tournament_id))->tournament_id;
            $link = env('APP_DEBUG') ? 'http://localhost:4200/dashboard/tournament-detail/'.$id.'?error=1' : 'https://iutest.kz/dashboard/tournament-detail/'.$id.'?error=1';
            return redirect($link);
        }
    }
}
