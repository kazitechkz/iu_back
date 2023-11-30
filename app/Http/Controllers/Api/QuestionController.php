<?php

namespace App\Http\Controllers\API;

use App\DTOs\AppealQuestionDTO;
use App\DTOs\CategoryQuestionCountDTO;
use App\DTOs\SubCategoryQuestionCountDTO;
use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\Category;
use App\Models\CommercialGroupPlan;
use App\Models\GroupPlan;
use App\Models\Question;
use App\Models\Step;
use App\Models\SubCategory;
use App\Models\SubStep;
use App\Models\UserQuestion;
use App\Services\AnswerService;
use App\Services\AttemptService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    private readonly QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }
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
//            $planIds = $user->activeSubscriptions()->pluck("plan_id")->toArray();
//            if(!$planIds){
//                return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
//            }
//            if(UserQuestion::where(["user_id"=>$user->id,"question_id"=>$question->id])->first()){
//                return response()->json(new ResponseJSON(status: false,message: "Вы уже сохранили вопрос"),400);
//            }
//            $groupIds = CommercialGroupPlan::whereIn("plan_id",$planIds)->pluck("group_id")->toArray();
//            if($groupIds){
//                if(in_array($question->group_id,$groupIds)){
//                    UserQuestion::add(["user_id"=>$user->id,"question_id"=>$question->id]);
//                    return response()->json(new ResponseJSON(status: true,message: "Вопрос успешно сохранен",data: true),200);
//                }
//            }
//            return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
            UserQuestion::add(["user_id"=>$user->id,"question_id"=>$question->id]);
            return response()->json(new ResponseJSON(status: true,message: "Вопрос успешно сохранен",data: true),200);
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
//            $planIds = $user->activeSubscriptions()->pluck("plan_id")->toArray();
//            if(!$planIds){
//                return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
//            }
//            $groupIds = CommercialGroupPlan::whereIn("plan_id",$planIds)->pluck("group_id")->toArray();
//            if($groupIds){
//                if(in_array($question->group_id,$groupIds)){
//                    $correct_answer = $this->questionService->getFiftyFifty($question);
//                    return response()->json(new ResponseJSON(status: true,message: "Вам дан шанс 50% на 50%",data: [$question->id=>$correct_answer]),200);
//                }
//            }
//            return response()->json(new ResponseJSON(status: false,message: "Вопрос не найден"),400);
            $correct_answer = $this->questionService->getFiftyFifty($question);
            return response()->json(new ResponseJSON(status: true,message: "Вам дан шанс 50% на 50%",data: [$question->id=>$correct_answer]),200);
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

    public function getSubCategoryQuestion(Request $request){
        try {
            $subCategoryQuestionCountDTO = SubCategoryQuestionCountDTO::fromRequest($request);
            $sub_category = SubCategory::firstWhere(["id"=>$subCategoryQuestionCountDTO->sub_category_id]);
            if(!$sub_category){
                return response()->json(new ResponseJSON(status: false,message: "Суб категория не найдена"),400);
            }
            $result = $this->questionService->getSubCategoryQuestionNumber($subCategoryQuestionCountDTO->sub_category_id,$subCategoryQuestionCountDTO->locale_id);
            return response()->json(new ResponseJSON(status: true,data: $result),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }

    public function getCategoryQuestion(Request $request){
        try {
            $categoryQuestionCountDTO = CategoryQuestionCountDTO::fromRequest($request);
            $category = Category::firstWhere(["id"=>$categoryQuestionCountDTO->category_id]);
            if(!$category){
                return response()->json(new ResponseJSON(status: false,message: "Категория не найдена"),400);
            }
            $result = $this->questionService->getCategoryQuestionNumber($categoryQuestionCountDTO->category_id,$categoryQuestionCountDTO->locale_id);
            return response()->json(new ResponseJSON(status: true,data: $result),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
