<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiValidationException;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\PlanService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubjectController extends Controller
{
    private readonly AttemptService $attemptService;
    private readonly QuestionService $questionService;
    private readonly AnswerService $answerService;
    private readonly PlanService $planService;

    public function __construct(AttemptService $attemptService, QuestionService $questionService, AnswerService $answerService, PlanService $planService)
    {
        $this->attemptService = $attemptService;
        $this->questionService = $questionService;
        $this->answerService = $answerService;
        $this->planService = $planService;
    }

    public function index()
    {
        try {
            $subjects = Subject::with('image')->get();
            return response()->json(new ResponseJSON(
                status: true, data: $subjects
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getSubjectsWithoutRequired()
    {
        try {
            $subjects = Subject::where('is_compulsory', 0)->get();
            return response()->json(new ResponseJSON(
                status: true, data: $subjects
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getMySubjects()
    {
        try {
            $subjects = $this->planService->get_subjects();
            return response()->json(new ResponseJSON(
                status: true, data: $subjects
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
