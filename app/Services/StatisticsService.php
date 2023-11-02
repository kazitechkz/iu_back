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

}
