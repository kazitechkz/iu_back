<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CareerQuiz;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class CareerController extends Controller
{
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
            $quiz = CareerQuiz::with(["career_quiz_questions"])->find($id);
            if(!$quiz){
                return ResponseService::NotFound("Не найдена информация по тесту");
            }
            return response()->json(new ResponseJSON(status: true,data: $quiz),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

}
