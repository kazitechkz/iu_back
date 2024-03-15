<?php

namespace App\Http\Controllers\Api;

use App\Events\BattleDetailEvent;
use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Battle;
use App\Models\BattleBet;
use App\Models\CareerQuizAnswer;
use App\Models\CareerQuizFeature;
use App\Models\CareerQuizQuestion;
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

    public function __construct(QuestionService $questionService,AttemptService $attemptService,BattleService $battleService, )
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
        $this->_battleService = $battleService;
    }



    public function test(Request $request)
    {
        $careerQuiz = CareerQuizFeature::where(["quiz_id" => 4])->select(
            [
                'title_kk',
                'description_kk',
                'activity_kk',
                'prospect_kk',
                'meaning_kk',
            ]
        )->get();
        return response()->json($careerQuiz);
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
}
