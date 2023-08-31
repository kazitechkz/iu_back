<?php

namespace App\Services;

use App\Models\GroupPlan;
use App\Models\Question;
use App\Models\SingleSubjectTest;
use App\Models\Subject;
use function Sodium\add;

class QuestionService
{
    const FREE_GROUP_ID = 2;
    const SINGLE_QUESTION_ID = 1;
    const CONTEXT_QUESTION_ID = 2;
    const MULTI_QUESTION_ID = 3;
    public function get_questions_for_unt($subject_one,$subject_two,$locale_id){
        $questions = [];
        //1 Check User Available Status free or premium (Plan Id)
        $plan_ids = auth()->user()->activeSubscriptions()->pluck("plan_id","plan_id");
        //2 Define Group Id for plan
        $groups = [];
        if(count($plan_ids) != 0){
            $available_groups = GroupPlan::whereIn("plan_id",$plan_ids)->pluck("group_id","group_id");
            array_push($groups,array_values($available_groups));
        }
        else{
            array_push($groups,self::FREE_GROUP_ID);
        }
        //3 We Get compulsory Subject
        $compulsory_subjects = Subject::where(["is_compulsory"=>true])->get();
        //4 Now we get standart questions number of each complusory
        $questions = self::get_questions($compulsory_subjects,$questions,$groups,$locale_id);
        //Now get the left 2 subjects
        $twosubjects = Subject::whereIn("id",[$subject_one,$subject_two])->get();
        $questions = self::get_questions($twosubjects,$questions,$groups,$locale_id);
        return $questions;
    }

    public function get_custom_subject_question($question_qty,$subject_id){

    }


    protected function get_questions($compulsory_subjects,$questions,$groups,$locale_id){
        foreach ($compulsory_subjects as $compulsory_subject){
            $single_subject_test = SingleSubjectTest::where(["subject_id" => $compulsory_subject->id])->first();
            $questions[$compulsory_subject->id] = [];
            if(($single_q_count = $single_subject_test->single_answer_questions_quantity) > 0){
                $questions_one = Question::whereIn("group_id",[3])->where(["subject_id" => $compulsory_subject->id,"type_id" => self::SINGLE_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder()->take($single_q_count)->get()->toArray();
                array_push($questions[$compulsory_subject->id],...$questions_one);
            }
            if(($contextual_q_count = $single_subject_test->contextual_questions_quantity) > 0){
                $question_context = Question::whereIn("group_id",[3])->where(["subject_id" => $compulsory_subject->id,"type_id" => self::CONTEXT_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder()->take($contextual_q_count)->get()->toArray();
                array_push($questions[$compulsory_subject->id],...$question_context);
            }
            if(($multiple_q_count = $single_subject_test->multi_answer_questions_quantity) > 0){
                $random_context = Question::whereIn("group_id",[3])->where(["subject_id" => $compulsory_subject->id,"type_id" => self::MULTI_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder()->take(1)->first();
                dd(Question::whereIn("group_id",[3])->where(["subject_id" => $compulsory_subject->id,"type_id" => self::MULTI_QUESTION_ID,"locale_id" => $locale_id,"context_id"=>$random_context->context_id])->with("context")->inRandomOrder()->take($multiple_q_count)->get()->toArray());
                $multiple_question = Question::whereIn("group_id",[3])->where(["subject_id" => $compulsory_subject->id,"type_id" => self::MULTI_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder()->take($multiple_q_count)->get()->toArray();
                array_push($questions[$compulsory_subject->id],...$multiple_question);
            }
        }
        return $questions;
    }
}
