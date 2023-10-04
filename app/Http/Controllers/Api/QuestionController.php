<?php

namespace App\Http\Controllers\API;

use App\DTOs\AppealQuestionDTO;
use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\CommercialGroupPlan;
use App\Models\GroupPlan;
use App\Models\Question;
use App\Models\UserQuestion;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    public function getSingleSubjectTest(Request $request)
    {
        try {
            $this->validate($request, [
                'subject_id' => 'required|exists:subjects,id',
                'locale_id' => 'required|exists:locales,id',
                'count_questions' => 'required'
            ]);
            $user = auth()->guard("api")->user();
            if (count($user->activeSubscriptions()) > 0) {
                $planId = $user->activeSubscriptions()->pluck('id', 'plan_id');
                $group = GroupPlan::whereIn("plan_id",$planId)->pluck("group_id","group_id");
                $questions = Question::where(['subject_id' => $request['subject_id'], 'locale_id' => $request['locale_id']])
                    ->whereIn("group_id",$group)
                    ->limit($request['count_questions'])
                    ->paginate(1);
            } else {
                $questions = Question::where(['subject_id' => $request['subject_id'], 'locale_id' => $request['locale_id']])
                    ->where("group_id",2)
                    ->limit($request['count_questions'])
                    ->paginate(1);
            }
            return response()->json(new ResponseJSON(
                status: true,
                data: $questions
            ));
        } catch (ValidationException $ex) {
            return response()->json(new ResponseJSON(
                status: false,
                errors: $ex->errors()
            ));
        }
    }

    public function saveQuestion(int $questionId){
        try{
            $user = auth()->guard("api")->user();
            $question = Question::find($questionId);
            if(!$question){
                return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
            }
            $planIds = $user->activeSubscriptions()->pluck("plan_id")->toArray();
            if(!$planIds){
                return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
            }
            if(UserQuestion::where(["user_id"=>$user->id,"question_id"=>$question->id])->first()){
                return response()->json(new ResponseJSON(status: false,message: "Вы уже сохранили вопрос"),400);
            }
            $groupIds = CommercialGroupPlan::whereIn("plan_id",$planIds)->pluck("group_id")->toArray();
            if($groupIds){
                if(in_array($question->group_id,$groupIds)){
                    UserQuestion::add(["user_id"=>$user->id,"question_id"=>$question->id]);
                    return response()->json(new ResponseJSON(status: true,message: "Вопрос успешно сохранен",data: true),200);
                }
            }
            return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }

    }
    public function getFiftyFifty(int $questionId){
        try{
            $user = auth()->guard("api")->user();
            $question = Question::find($questionId);
            if(!$question){
                return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
            }
            $planIds = $user->activeSubscriptions()->pluck("plan_id")->toArray();
            if(!$planIds){
                return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
            }
            $groupIds = CommercialGroupPlan::whereIn("plan_id",$planIds)->pluck("group_id")->toArray();
            if($groupIds){
                if(in_array($question->group_id,$groupIds)){
                    $all_answer = ['answer_a',
                        'answer_b',
                        'answer_c',
                        'answer_d',
                        'answer_e',
                        'answer_f',
                        'answer_g',
                        'answer_h',];
                    $correct_answers = explode(",",$question->correct_answers);
                    $answers = [];
                    foreach ($correct_answers as $key=>$correct_answer){
                        array_push($answers,"answer_".$correct_answer);
                    }
                    $correct_one = array_rand($answers);
                    $all_answer = array_diff($all_answer,$answers);
                    $proposal_answer = [];
                    foreach ($all_answer as $answer_value){
                        if($question[$answer_value]){
                            array_push($proposal_answer,$answer_value);
                        }
                    }
                    $incorrect_one = array_rand($proposal_answer);
                    $correct_answer = [$answers[$correct_one],$proposal_answer[$incorrect_one]];
                    return response()->json(new ResponseJSON(status: true,message: "Вам дан шанс 50% на 50%",data: [$question->id=>$correct_answer]),200);
                }
            }
            return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }

    }

    public function appealQuestion(Request $request){
        try {
            $user = auth()->guard("api")->user();
            $input = $request->all();
            $input["user_id"] = $user->id;
            $appeal_question = AppealQuestionDTO::fromArray($input);
            if (Appeal::where(["user_id" => $user->id, "question_id" => $request->get("question_id")])->first()) {
                return response()->json(new ResponseJSON(status: false, message: "Вы уже оставляли заявку на текущий вопрос"), 400);
            } else {
                Appeal::add($appeal_question->toArray());
                return response()->json(new ResponseJSON(status: true,message: "Спасибо за отзыв! Мы обязательно рассмотрим данный вопрос",data: true),200);
            }
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }


    }
}
