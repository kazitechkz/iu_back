<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CareerQuizFeature;
use App\Services\AttemptService;
use App\Services\BattleService;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Instagram\User\BusinessDiscovery;


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
        $config = array( // instantiation config params
            'user_id' => '122115354104225045',
            'username' => 'xutosh17', // string of the Instagram account username to get data on
            'access_token' => 'EAFg11ib1N2sBO6edxt5idq6ZBeEi4nPAv744uDrpm8FqVeA6MoB1l2sWcBJ3p5GdXCsN82U8jZApLXbeEfAsRnri1jVHvDsqreRr6eX7cooHJpkQ76ZBoRDVOZAgX3YI1IxbBFc0wHp2ZBBuWVf4u8wAMw6LS3IGISCOTEGQOtMRtG8pvA4TsKxNqqqnrLGXyGn76rfRL6GaXtmpnASuOmgHPneTLj78RepMZD',
        );

        $businessDiscovery = new BusinessDiscovery( $config );

        $userBusinessDiscovery = $businessDiscovery->getSelf();
        dd($userBusinessDiscovery);
//        $user = User::with(['attempts' => function ($query) {
//            $query->where('type_id',1)->whereBetween('created_at', [Carbon::now()->startOfDay()->subMonth(), Carbon::now()->endOfDay()])
//                ->with('attempt_subjects');
////            $query->where('type_id',1)->whereBetween('created_at', [Carbon::now()->startOfDay()->subWeek(), Carbon::now()->endOfDay()]);
//        }])->findOrFail(32);
//        if ($user->attempts) {
//            $data[$user->name]['parent_name'] = $user->parent_name ? $user->parent_name : 'Mother';
//            $data[$user->name]['total_count'] = $user->attempts->count();
//            $data[$user->name]['average_score'] = $user->attempts->sum('points')/$user->attempts->count();
//            foreach ($user->attempts as $attempt) {
//                foreach ($attempt->attempt_subjects as $attempt_subject) {
//                    $data[$user->name]['subjects'][$attempt_subject->attempt_id][] = $attempt_subject->subject_id;
//                }
//            }
//        }
//        return response()->json(['data' => $data]);
    }
}
