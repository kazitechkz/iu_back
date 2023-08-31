<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private QuestionService $_questionService;
    public function __construct(QuestionService $questionService)
    {
        $this->_questionService = $questionService;
    }


    public function test(){
        dd($this->_questionService->get_questions_for_unt(4,5,1));
    }
}
