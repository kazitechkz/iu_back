<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AttemptService;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private QuestionService $_questionService;
    private AttemptService $_attemptService;
    public function __construct(QuestionService $questionService,AttemptService $attemptService)
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
    }


    public function test(){

        $questions = $this->_questionService->get_questions_with_subjects([5,6,],1);
        $points = $this->_questionService->get_questions_max_point($questions);
        $attempt = $this->_attemptService->create_attempt(type_id: 2,locale_id: 1,max_points:$points,questions: $questions,time: 240 );
        dd($attempt);

    }
}
