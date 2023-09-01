<?php

namespace App\Services;

use App\Models\GroupPlan;
use App\Models\Question;
use App\Models\SingleSubjectTest;
use App\Models\Subject;


class QuestionService
{
    const FREE_GROUP_ID = 2;
    const SINGLE_QUESTION_ID = 1;
    const CONTEXT_QUESTION_ID = 2;
    const MULTI_QUESTION_ID = 3;

    const SINGLE_QUESTION_VALUE = 1;
    const CONTEXT_QUESTION_VALUE = 1;
    const MULTI_QUESTION_VALUE = 2;


    public function get_questions_with_subjects($subjects,$locale_id){
        $questions = [];
        //1 Check User Available Status free or premium (Plan Id)
        $plan_ids = auth()->user()->activeSubscriptions()->pluck("plan_id","plan_id");
        //2 Define Group Id for plan
        $groups = [];
        if(count($plan_ids) != 0){
            $available_groups = GroupPlan::whereIn("plan_id",$plan_ids)->pluck("group_id","group_id");
            if(count($available_groups == 0)){
                array_push($groups,self::FREE_GROUP_ID);
            }
            else{
                array_push($groups,...$available_groups);
            }
        }
        else{
            array_push($groups,self::FREE_GROUP_ID);
        }
        if(count($subjects) > 1){
            //        //3 We Get compulsory Subject
            $compulsory_subjects = Subject::where(["is_compulsory"=>true])->get();
            //4 Now we get standart questions number of each complusory
            $questions = self::get_questions($compulsory_subjects,$questions,$groups,$locale_id);
        }
        //Now get the left subjects
        $twosubjects = Subject::whereIn("id",$subjects)->get();
        $questions = self::get_questions($twosubjects,$questions,$groups,$locale_id);
        return $questions;
    }


    public function get_questions_max_point($questions){
        $count = 0;
        foreach ($questions as $question){
            foreach ($question as $questionItem){
                switch ($questionItem["type_id"]){
                    case self::SINGLE_QUESTION_ID :{
                        $count +=self::SINGLE_QUESTION_VALUE;
                        break;
                    }
                    case self::CONTEXT_QUESTION_ID:{
                        $count +=self::CONTEXT_QUESTION_VALUE;
                        break;
                    }
                    case self::MULTI_QUESTION_ID:{
                        $count +=self::MULTI_QUESTION_VALUE;
                        break;
                    }
                }
            }
        }
        return $count;
    }



    protected function get_questions($compulsory_subjects,$questions,$groups,$locale_id){
        foreach ($compulsory_subjects as $compulsory_subject){
            $single_subject_test = SingleSubjectTest::where(["subject_id" => $compulsory_subject->id])->first();
            $questions[$compulsory_subject->id] = [];
            if(($single_q_count = $single_subject_test->single_answer_questions_quantity) > 0){
                $single_question_query = Question::with("context")->where(["subject_id" => $compulsory_subject->id,"type_id" => self::SINGLE_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder();
                $questions_one = $single_question_query->take($single_q_count)->get()->toArray();
                array_push($questions[$compulsory_subject->id],...$questions_one);
            }
            if(($contextual_q_count = $single_subject_test->contextual_questions_quantity) > 0){
                $banned_ids = [0];
                for ($i = 1; $i <= $contextual_q_count/5; $i++) {
                    $random_context = $this->get_context_questions(5,$locale_id,$compulsory_subject,$banned_ids);
                    array_push($banned_ids,$random_context->context_id);
                    $question_context = Question::with("context")->where(["subject_id" => $compulsory_subject->id,"type_id" => self::CONTEXT_QUESTION_ID,"locale_id" => $locale_id,"context_id"=>$random_context->context_id])->inRandomOrder()->take($contextual_q_count)->get()->toArray();
                    array_push($questions[$compulsory_subject->id],...$question_context);
                }
            }
            if(($multiple_q_count = $single_subject_test->multi_answer_questions_quantity) > 0){
                $multiple_question_query = Question::with("context")->where(["subject_id" => $compulsory_subject->id,"type_id" => self::MULTI_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder();
                $multiple_question = $multiple_question_query->take($multiple_q_count)->get()->toArray();
                array_push($questions[$compulsory_subject->id],...$multiple_question);
            }
        }
        return $questions;
    }

    protected function get_context_questions(int $limit,$locale_id,$compulsory_subject,$banned_ids = [0]){
       $query = Question::whereNotIn("context_id",$banned_ids)->whereIn("group_id",[3])->where(["subject_id" => $compulsory_subject->id,"type_id" => self::CONTEXT_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder()->first();
       if(!$query){
            throw new \Error("Questions doesnt exists");
        }
       if((Question::whereIn("group_id",[3])->where(["subject_id" => $compulsory_subject->id,"type_id" => self::CONTEXT_QUESTION_ID,"locale_id" => $locale_id,"context_id"=>$query->context_id])->count()) < $limit){
           $banned_ids[$query->context_id] = $query->context_id;
           return $this->get_context_questions($limit,$locale_id,$compulsory_subject,$banned_ids);
       }
       else{
           return $query;
       }
    }
}
