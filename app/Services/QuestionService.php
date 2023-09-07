<?php

namespace App\Services;

use App\Models\GroupPlan;
use App\Models\Question;
use App\Models\SingleSubjectTest;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;


class QuestionService
{
    const FREE_GROUP_ID = 2;
    const SINGLE_QUESTION_ID = 1;
    const CONTEXT_QUESTION_ID = 2;
    const MULTI_QUESTION_ID = 3;

    const SINGLE_QUESTION_VALUE = 1;
    const CONTEXT_QUESTION_VALUE = 1;
    const CONTEXT_QUESTION_NUMBER = 5;
    const MULTI_QUESTION_VALUE = 2;
    const UNT_TYPE = 1;
    const CASUAL_TYPE = 2;
    const TOURNAMENT_TYPE=3;

    public function get_questions_with_subjects($subjects,$locale_id,$group_type_id){
        $questions = [];
        //1 Check User Available Status free or premium (Plan Id)
        $plan_ids = auth()->user()->activeSubscriptions()->pluck("plan_id","plan_id");
        //2 Define Group Id for plan
        $groups = [];
        if($group_type_id == self::UNT_TYPE || $group_type_id == self::CASUAL_TYPE){
            if(count($plan_ids) != 0){
                $available_groups = GroupPlan::whereIn("plan_id",$plan_ids)->pluck("group_id","group_id");
                if(count($available_groups )==0){
                    array_push($groups,self::FREE_GROUP_ID);
                }
                else{
                    array_push($groups,...$available_groups);
                }
            }
            else{
                array_push($groups,self::FREE_GROUP_ID);
            }
        }
        else{
            array_push($groups,1);
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



    public function get_questions($compulsory_subjects,$questions,$type_id,$locale_id,$single_question_query =0,$contextual_question_count =0,$multiple_question_count = 0){
        foreach ($compulsory_subjects as $compulsory_subject){
            $single_q_count = $single_question_query;
            $contextual_q_count = $contextual_question_count;
            $multiple_q_count = $multiple_question_count;
            if($type_id == self::UNT_TYPE || $type_id == self::CASUAL_TYPE){
                $single_subject_test = SingleSubjectTest::where(["subject_id" => $compulsory_subject->id])->first();
                $single_q_count = $single_subject_test->single_answer_questions_quantity;
                $contextual_q_count = $single_subject_test->contextual_questions_quantity;
                $multiple_q_count = $single_subject_test->multi_answer_questions_quantity;
            }
            $questions[$compulsory_subject->id] = [];
            if(($single_q_count) > 0){
                $single_question_query = Question::with("context")->where(["subject_id" => $compulsory_subject->id,"type_id" => self::SINGLE_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder();
                $questions_one = $single_question_query->take($single_q_count)->get()->toArray();
                array_push($questions[$compulsory_subject->id],...$questions_one);
            }
            if(($contextual_q_count) > 0){
                $context_questions = $this->get_context_questions($locale_id,$compulsory_subject,$contextual_q_count/self::CONTEXT_QUESTION_NUMBER);
                array_push($questions[$compulsory_subject->id],...$context_questions);
            }
            if(($multiple_q_count) > 0){
                $multiple_question_query = Question::with("context")->where(["subject_id" => $compulsory_subject->id,"type_id" => self::MULTI_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder();
                $multiple_question = $multiple_question_query->take($multiple_q_count)->get()->toArray();
                array_push($questions[$compulsory_subject->id],...$multiple_question);
            }
        }
        return $questions;
    }

    protected function get_context_questions($locale_id,$compulsory_subject,$rand_int){
        $questions = Question::where(["type_id"=>self::CONTEXT_QUESTION_ID,"subject_id" => $compulsory_subject->id,"locale_id" => $locale_id])->select("context_id",DB::raw('COUNT(questions.context_id) as context_qty'))->groupBy("context_id")->having(DB::raw('count(context_id)'), '=', 5)->pluck("context_qty","context_id")->toArray();
        if(count($questions)>=$rand_int){
                $ids = array_rand($questions,$rand_int);
                $ids = is_array($ids) ? $ids : [$ids];
                return Question::whereIn("context_id",$ids)->with("context")->get()->toArray();
        }
        else{
            throw new \Exception("Question in {$compulsory_subject->title_ru} is insufficient");
        }
    }


}
