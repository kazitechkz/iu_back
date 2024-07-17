<?php

namespace App\Http\Controllers\Api;

use App\DTOs\FinishCareerQuizDTO;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Models\CareerCoupon;
use App\Models\CareerQuiz;
use App\Models\CareerQuizAttempt;
use App\Models\CareerQuizAttemptResult;
use App\Models\CareerQuizGroup;
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
            $user = auth()->guard("api")->user();
            $quizzes = CareerQuiz::with(["career_quiz_group","career_quiz_creators.career_quiz_author","file"])->where(["status" => true])->withCount(["career_quiz_questions"])->orderBy("order","ASC")->paginate(20);
            $purchasedCareerQuiz = CareerCoupon::where(["user_id" => $user->id,"status"=>true,"is_used" => false])->pluck("career_quiz_id")->toArray();
            return response()->json(new ResponseJSON(status: true,data: ["quizzes"=>$quizzes,"purchased"=>$purchasedCareerQuiz]),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function careerQuizDetail($id){
        try{
            $user = auth()->guard("api")->user();
            $quiz = CareerQuiz::with(["career_quiz_creators.career_quiz_author.file","career_quiz_group","file"])->where(["status" => true])->find($id);
            if(!$quiz){
                return ResponseService::NotFound("Не найдена информация по тесту");
            }
            $purchased = CareerCoupon::where(["user_id" => $user->id,"career_quiz_id" => $quiz->id,"is_used" => false,"status" => true])->exists();
            return response()->json(new ResponseJSON(status: true,data: ["quiz"=>$quiz,"is_purchased"=>$purchased]),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function passCareerQuiz($id){
        try{
            $user = auth()->guard("api")->user();
            $quiz = CareerQuiz::with(["career_quiz_questions","career_quiz_answers"])->where(["status" => true])->find($id);
            if(!$quiz){
                return ResponseService::NotFound("Не найдена информация по тесту");
            }
            if($quiz->price > 0){
                $purchased = CareerCoupon::where(["user_id" => $user->id,"career_quiz_id" => $quiz->id,"is_used" => false,"status" => true])->exists();
                if(!$purchased){
                    return ResponseService::NotFound("Вы не приобрели данный продукт");
                }
            }
            if($quiz->career_quiz_questions->count() == 0){
                return ResponseService::ValidationException("Вопросов недостаточно");
            }
            if($quiz->code == CareerQuizService::CAREER_QUESTIONS_AND_ANSWERS){
                $quiz->load("career_quiz_questions.career_quiz_answers");
            }
            return response()->json(new ResponseJSON(status: true,data: $quiz),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function finishCareerQuiz(Request $request){
        try{
            $user = auth()->guard("api")->user();
            $resultQuiz = FinishCareerQuizDTO::fromRequest($request);
            $careerQuiz = CareerQuiz::find($request->get("quiz_id"));
            if($careerQuiz->price > 0){
                $purchased = CareerCoupon::where(["user_id" => $user->id,"career_quiz_id" => $resultQuiz->quiz_id,"is_used" => false,"status" => true])->first();
                if(!$purchased){
                    throw new NotFoundException("Вы не приобрели данный продукт");
                }
            }
            $attemptId = $this->careerQuizService->finishCareerQuiz($resultQuiz);
            if ($careerQuiz->price > 0){
                $purchased->edit(["is_used"=>true]);
            }
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

    public function careerQuizGroupList(){
        try{
            $user = auth()->guard("api")->user();
            $careerQuizGroups = CareerQuizGroup::with(["career_quiz_authors.file"])->with("career_quizzes",function ($query){
                $query->where(["status"=>true])->with("file");
            })->get();
            $purchasedCareerQuiz = CareerCoupon::where(["user_id" => $user->id,"status"=>true,"is_used" => false])->pluck("career_quiz_id")->toArray();
            return response()->json(new ResponseJSON(status: true,data: ["group"=>$careerQuizGroups,"purchased"=>$purchasedCareerQuiz]),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function myCareerAttempts(){
        try{
            $user = auth()->guard("api")->user();
            $attempts = CareerQuizAttempt::with(["user","career_quiz.career_quiz_group","career_quiz.file"])->whereHas('career_quiz')->where(["user_id" => $user->id])->paginate(15);
            return response()->json(new ResponseJSON(status: true,data: $attempts),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

}
