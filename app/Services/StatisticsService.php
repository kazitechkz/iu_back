<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Attempt;
use App\Models\AttemptQuestion;
use App\Models\AttemptSubject;
use App\Models\Question;
use App\Models\SubCategory;
use App\Models\Subject;
use Carbon\Carbon;

class StatisticsService
{

    public function getResultByAttemptId($id){
        $user = auth()->guard("api")->user();
        $result = [];
        $attempt = Attempt::where(["id"=>$id,"user_id" => $user->id])->where("end_at","!=",null)->with(["locale","attempt_type","user"])->first();
        if(!$attempt){
            throw new NotFoundException("Попытка сдачи не найдена");
        }
        $result = ["attempt"=>$attempt];
        $attempt_subjects = AttemptSubject::where(["attempt_id" => $attempt->id])->with(["subject.image"])->get();
        if(!$attempt_subjects->count()){
            throw new NotFoundException("Попытка сдачи не найдена");
        }
        $subject_iterator = 0;
        foreach ($attempt_subjects as $attempt_subject){
            $result["subjects"][$subject_iterator] = $attempt_subject->subject;
            $point = AttemptQuestion::where(["attempt_subject_id" => $attempt_subject->id])->sum("point");
            $right = AttemptQuestion::where(["attempt_subject_id" => $attempt_subject->id,"is_right" => true])->count();
            $not_right = AttemptQuestion::where(["attempt_subject_id" => $attempt_subject->id,"is_right" => false])->count();
            $result["subject_result"][$subject_iterator] = ["subject_id"=>$attempt_subject->subject->id,"right"=>$right,"not_right"=>$not_right,"total"=>$right + $not_right,"point"=>$point];
            $subject_iterator++;
        }
        return $result;
    }

    public function getStatByAttemptId($id){
        $user = auth()->guard("api")->user();
        $result = [];
        $attempt = Attempt::where(["id"=>$id,"user_id" => $user->id])->where("end_at","!=",null)->with(["locale","attempt_type","user"])->first();
        if(!$attempt){
            throw new NotFoundException("Попытка сдачи не найдена");
        }
        $result = ["attempt"=>$attempt];
        $attempt_subjects = AttemptSubject::where(["attempt_id" => $attempt->id])->with(["subject.image"])->get();
        if(!$attempt_subjects->count()){
            throw new NotFoundException("Попытка сдачи не найдена");
        }
        $subject_iterator = 0;
        foreach ($attempt_subjects as $attempt_subject){
            $result["subjects"][$subject_iterator] = $attempt_subject->subject;
            $attempt_questions_ids = AttemptQuestion::where(["attempt_subject_id" => $attempt_subject->id])->pluck("question_id","question_id")->toArray();
            $subcategory_ids = Question::whereIn("id",$attempt_questions_ids)->pluck("sub_category_id","sub_category_id")->toArray();
            foreach ($subcategory_ids as $subcategory_id){
                $question_ids = Question::whereIn("id",$attempt_questions_ids)->where(["sub_category_id" => $subcategory_id])->pluck("id","id")->toArray();
                $subcategory = SubCategory::with("category")->firstWhere(["id"=>$subcategory_id]);
                $right = AttemptQuestion::whereIn("question_id",$question_ids)->where(["attempt_subject_id" => $attempt_subject->id,"is_right" => true])->count();
                $not_right = AttemptQuestion::whereIn("question_id",$question_ids)->where(["attempt_subject_id" => $attempt_subject->id,"is_right" => false])->count();
                $result["stat_by_attempt"][] = ["sub_category"=>$subcategory,"total"=>$right + $not_right,"right"=>$right,"not_right"=>$not_right,"subject_id"=>$attempt_subject->subject_id];
            }
            $subject_iterator++;
        }
        return $result;
    }

    public function getStatByAttemptIdForTeacher($attempt_id, $user_id): array
    {
        $result = [];
        $attempt = Attempt::where(["id" => $attempt_id, "user_id" => $user_id])->where("end_at", "!=", null)->with(["locale", "attempt_type", "user"])->first();
        if (!$attempt) {
            throw new NotFoundException("Попытка сдачи не найдена");
        }
        $result = ["attempt" => $attempt];
        $attempt_subjects = AttemptSubject::where(["attempt_id" => $attempt->id])->with(["subject.image"])->get();
        if (!$attempt_subjects->count()) {
            throw new NotFoundException("Попытка сдачи не найдена");
        }
        $subject_iterator = 0;
        foreach ($attempt_subjects as $attempt_subject) {
            $result["subjects"][$subject_iterator] = $attempt_subject->subject;
            $attempt_questions_ids = AttemptQuestion::where(["attempt_subject_id" => $attempt_subject->id])->pluck("question_id", "question_id")->toArray();
            $subcategory_ids = Question::whereIn("id", $attempt_questions_ids)->pluck("sub_category_id", "sub_category_id")->toArray();
            foreach ($subcategory_ids as $subcategory_id) {
                $questions = Question::with(['attempt_questions' => function($query) use ($attempt_subject){
                    $query->where('attempt_subject_id', $attempt_subject->id);
                }])->whereIn("id", $attempt_questions_ids)->where(["sub_category_id" => $subcategory_id])->get();
                $question_ids = $questions->pluck("id", "id")->toArray();
                $subcategory = SubCategory::with("category")->firstWhere(["id" => $subcategory_id]);
                $right = AttemptQuestion::whereIn("question_id", $question_ids)->where(["attempt_subject_id" => $attempt_subject->id, "is_right" => 1])->count();
                $not_right = AttemptQuestion::whereIn("question_id", $question_ids)->where(["attempt_subject_id" => $attempt_subject->id, "is_right" => 0])->count();
                $result["stat_by_attempt"][] = ["sub_category" => $subcategory, "total" => $right + $not_right, "right" => $right, "not_right" => $not_right, "subject_id" => $attempt_subject->subject_id, 'questions' => $questions];
            }
            $subject_iterator++;
        }
        return $result;
    }

    public function getStatBySubjectId($subject_id){
        $user = auth()->guard("api")->user();
        $result = [];
        $subject = Subject::with("image")->firstWhere(["id"=>$subject_id]);
        $attempt_subjects = AttemptSubject::where(["subject_id" => $subject_id])
            ->whereHas("attempt",function ($query) use ($user) {
                $query->where(["user_id" => $user->id])->where("end_at","!=",null);
            })
            ->get();
        if(!$attempt_subjects->count()){
            throw new NotFoundException("Попытка сдачи не найдена");
        }
        $result["subject"] = $subject;
        foreach ($attempt_subjects as $attempt_subject){
            $attempt_questions_ids = AttemptQuestion::where(["attempt_subject_id" => $attempt_subject->id])->pluck("question_id","question_id")->toArray();
            $subcategory_ids = Question::whereIn("id",$attempt_questions_ids)->pluck("sub_category_id","sub_category_id")->toArray();
            foreach ($subcategory_ids as $subcategory_id){
                $question_ids = Question::whereIn("id",$attempt_questions_ids)->where(["sub_category_id" => $subcategory_id])->pluck("id","id")->toArray();
                $subcategory = SubCategory::with("category")->firstWhere(["id"=>$subcategory_id]);
                $right = AttemptQuestion::whereIn("question_id",$question_ids)->where(["attempt_subject_id" => $attempt_subject->id,"is_right" => true])->count();
                $not_right = AttemptQuestion::whereIn("question_id",$question_ids)->where(["attempt_subject_id" => $attempt_subject->id,"is_right" => false])->count();
                $result["stat_by_subject"][] = ["sub_category"=>$subcategory,"total"=>$right + $not_right,"right"=>$right,"not_right"=>$not_right,"subject_id"=>$attempt_subject->subject_id];
            }
        }
        return $result;
    }


    public function getFullStatByUser($type_id = null, $start_at = null, $end_at = null,$subject_id = null){
        $user = auth()->guard("api")->user();
        $attempt_condition = ["user_id"=>$user->id];
        $attempt_query = Attempt::where("end_at","!=",null);
        if($type_id){
            $attempt_condition["type_id"] = $type_id;
        }
        $attempt_query = $attempt_query->where($attempt_condition);
        if($subject_id){
            $attempt_query = $attempt_query->whereHas("attempt_subjects",function ($query) use ($subject_id){
               $query->where("subject_id","=",$subject_id);
            });
        }
        $local_start_at = $start_at ? Carbon::createFromFormat('d/m/Y',$start_at) : Carbon::now()->addDays(-7);
        $local_end_at = $end_at ? Carbon::createFromFormat('d/m/Y',$end_at) : Carbon::now();
        $attempt_query = $attempt_query->where("start_at",">=",$local_start_at)->where("start_at","<=",$local_end_at);
        $attempt_query = $attempt_query->with(["attempt_subject_questions.question.subcategory","attempt_subjects"]);
        $attempts = $attempt_query->get();
        $result = [];
        $result["subjects"] = [];
        foreach ($attempts as $attempt){
            $data = collect($attempt->attempt_subject_questions->groupBy(["question.subject_id","question.sub_category_id"])->toArray());
            foreach ($data as $subject_id => $subjectQuestionItem){
                $result["subjects"][$subject_id] = [];
                foreach ($subjectQuestionItem as $sub_category_id => $subCategoryItems){
                    $result["subjects"][$subject_id][$sub_category_id]["sub_category"] = $subCategoryItems[0]["question"]["subcategory"];
                    $right = 0;
                    $not_right = 0;
                    foreach ($subCategoryItems as $subCategoryItem){
                        if ($subCategoryItem["is_right"]){
                            $right++;
                        }
                        else{
                            $not_right++;
                        }
                    }
                    $result["subjects"][$subject_id][$sub_category_id]["right"] = $right;
                    $result["subjects"][$subject_id][$sub_category_id]["not_right"] = $not_right;
                }
            }
        }
        $result["count"] = $attempt_query->count();
        $result["average"] = $attempt_query->avg("points");
        $result["min"] = $attempt_query->min("points");
        $result["max"] = $attempt_query->max("points");
        $result["question_quantity"] = collect($attempt_query->withCount("attempt_subject_questions")->get()->toArray())->sum("attempt_subject_questions_count");
        return  $result;
    }

}
