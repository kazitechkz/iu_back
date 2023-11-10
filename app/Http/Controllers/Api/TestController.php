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


    public function test(Request $request)
    {

    }
}
