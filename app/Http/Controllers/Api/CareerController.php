<?php

namespace App\Http\Controllers\Api;

use App\DTOs\FinishCareerQuizDTO;
use App\Http\Controllers\Controller;
use App\Models\CareerQuiz;
use App\Models\CareerQuizAttempt;
use App\Models\CareerQuizAttemptResult;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\CareerQuizService;
use App\Services\PlanService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    private readonly CareerQuizService $careerQuizService;

    public function __construct(CareerQuizService $careerQuizService)
    {
        $this->careerQuizService = $careerQuizService;
    }

    public function careerQuizzes(Request $request){
        try{
            $quizzes = CareerQuiz::with(["career_quiz_group","career_quiz_creators.career_quiz_author","file"])->withCount(["career_quiz_questions"])->orderBy("created_at","DESC")->paginate(20);
            return response()->json(new ResponseJSON(status: true,data: $quizzes),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function careerQuizDetail($id){
        try{
            $quiz = CareerQuiz::with(["career_quiz_creators.career_quiz_author.file","career_quiz_group","file"])->find($id);
            if(!$quiz){
                return ResponseService::NotFound("Не найдена информация по тесту");
            }
            return response()->json(new ResponseJSON(status: true,data: $quiz),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function passCareerQuiz($id){
        try{
            $quiz = CareerQuiz::with(["career_quiz_questions","career_quiz_answers"])->find($id);
            if(!$quiz){
                return ResponseService::NotFound("Не найдена информация по тесту");
            }
            return response()->json(new ResponseJSON(status: true,data: $quiz),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function finishCareerQuiz(Request $request){
        try{
            $resultQuiz = FinishCareerQuizDTO::fromRequest($request);
            $attemptId = $this->careerQuizService->finishCareerQuiz($resultQuiz);
            return response()->json(new ResponseJSON(status: true,data: $attemptId),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function resultCareerQuiz($id){
        try{
            $user = auth()->guard("api")->user();
            $result = CareerQuizAttempt::with(["career_quiz_attempt_results.career_quiz_feature.file","career_quiz.file"])
                ->where(["user_id" => $user->id,"id" => $id])
                ->first();
            if(!$result){
                return ResponseService::NotFound("Результат не найден");
            }
            return response()->json(new ResponseJSON(status: true,data: $result),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

}
