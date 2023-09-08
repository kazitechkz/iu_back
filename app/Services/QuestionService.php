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

    public function get_questions_with_subjects($subjects,$locale_id,$attempt_type_id,$single_q_count =0, $contextual_q_count =0, $multiple_q_count = 0){
        $questions = [];
        $groups = $this->get_groups(
            attempt_type_id:$attempt_type_id
        );
        $subject_ids = $this->get_subject(
            subjects:$subjects,
            attempt_type_id: $attempt_type_id
        );
        $questions = self::get_questions(
            compulsory_subjects: $subject_ids,
            questions: $questions,
            type_id:$attempt_type_id,
            locale_id: $locale_id,
            single_q_count: $single_q_count,
            contextual_q_count: $contextual_q_count,
            multiple_q_count: $multiple_q_count
        );
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



    protected function get_questions($compulsory_subjects,
                                  $questions,
                                  $type_id,
                                  $locale_id,
                                  $single_q_count,
                                  $contextual_q_count,
                                  $multiple_q_count){
        foreach ($compulsory_subjects as $compulsory_subject){
            if($type_id == self::UNT_TYPE || $type_id == self::CASUAL_TYPE){
                $single_subject_test = SingleSubjectTest::where(["subject_id" => $compulsory_subject->id])->first();
                $single_q_count = $single_subject_test->single_answer_questions_quantity;
                $contextual_q_count = $single_subject_test->contextual_questions_quantity;
                $multiple_q_count = $single_subject_test->multi_answer_questions_quantity;
            }
            $questions[$compulsory_subject->id] = [];
            if($single_q_count > 0){
                $questions_one = $this->get_single_questions($locale_id,$compulsory_subject,$single_q_count);
                array_push($questions[$compulsory_subject->id],...$questions_one);
            }
            if($contextual_q_count > 0){
                $context_questions = $this->get_context_questions($locale_id,$compulsory_subject,$contextual_q_count/self::CONTEXT_QUESTION_NUMBER);
                array_push($questions[$compulsory_subject->id],...$context_questions);
            }
            if($multiple_q_count > 0){
                $multiple_question = $this->get_multiple_questions($locale_id,$compulsory_subject,$multiple_q_count);
                array_push($questions[$compulsory_subject->id],...$multiple_question);
            }
        }
        return $questions;
    }


    protected function get_single_questions($locale_id,$compulsory_subject,$count){
        $single_question_query = Question::with("context")->where(["subject_id" => $compulsory_subject->id,"type_id" => self::SINGLE_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder();
        $questions_one = $single_question_query->take($count)->get()->toArray();
        return $questions_one;
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
    protected function get_multiple_questions($locale_id,$compulsory_subject,$count){
        $multiple_question_query = Question::with("context")->where(["subject_id" => $compulsory_subject->id,"type_id" => self::MULTI_QUESTION_ID,"locale_id" => $locale_id])->inRandomOrder();
        $multiple_question = $multiple_question_query->take($count)->get()->toArray();
        return $multiple_question;
    }



    protected function get_groups(int $attempt_type_id){
        //1 Check User Available Status free or premium (Plan Id)
        $plan_ids = auth()->user()->activeSubscriptions()->pluck("plan_id","plan_id");
        //2 Define Group Id for plan
        $groups = [];
        //If UNT OR CASUAL PASS
        if($attempt_type_id == self::UNT_TYPE || $attempt_type_id == self::CASUAL_TYPE){
            if(count($plan_ids) != 0){
                //Get Groups from GROUP
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
        return $groups;
    }


    protected function get_subject($subjects,$attempt_type_id){
        if(count($subjects) == 0){
            throw new \Exception("Не выбраны дисциплины");
        }
        $subject_ids = [];
        if($attempt_type_id == QuestionService::UNT_TYPE){
            $compulsory_subjects = Subject::where(["is_compulsory"=>true])->pluck("id","id");
            array_push($subject_ids,...$compulsory_subjects);
        }
        array_push($subject_ids,...$subjects);
        if($attempt_type_id == QuestionService::UNT_TYPE){
            if(count($subject_ids) != 5){
                throw new \Exception("Question Complete is insufficient");
            }
        }
        return Subject::whereIn("id",$subject_ids)->get();
    }


}
