<?php

namespace App\Http\Controllers\Api;

use App\Events\BattleDetailEvent;
use App\Http\Controllers\Controller;
use App\Models\Battle;
use App\Models\BattleBet;
use App\Services\AttemptService;
use App\Services\BattleService;
use App\Services\QuestionService;
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
        $this->_battleService->battleTimeOut(67);
    }
}
