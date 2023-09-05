<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttemptQuestion;
use App\Models\Question;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\PlanService;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    private QuestionService $_questionService;
    private AttemptService $_attemptService;
    private AnswerService $_answerService;
    public function __construct(QuestionService $questionService,AttemptService $attemptService,AnswerService $answerService)
    {
        $this->_questionService = $questionService;
        $this->_attemptService = $attemptService;
        $this->_answerService = $answerService;
    }


    public function test(){
        //We need locale_id, subjects = [1,2], type_id,time
        $questions = $this->_questionService->get_questions_with_subjects([5,6,],1);
        $points = $this->_questionService->get_questions_max_point($questions);
        $attempt = $this->_attemptService->create_attempt(type_id: 2,locale_id: 1,max_points:$points,questions: $questions,time: 240 );
        dd($attempt);
    }

    public function answerTest(){
//        $this->_answerService->check(1,1,12811,"c");//1
//        $this->_answerService->check(1,2,6447,"a");//1
//        //3
//        $this->_answerService->check(1,5,16278,"h,f,e");//1
//        //2
//        $this->_answerService->check(1,5,16147,"f,g"); //2
//        //1
        //$this->_answerService->check(1,5,16268,"d"); //2
        //$this->_answerService->check(1,4,15224,"B"); //2
    }

    public function finishTest(){
        $this->_answerService->finishTest(1);
    }

    public function subjectTest(){
        $planService = new PlanService();
        dd($planService->getSubjects());
    }


}
