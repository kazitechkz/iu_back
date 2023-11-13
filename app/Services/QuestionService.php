<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\QuestionException;
use App\Http\Livewire\SingleSubjectTest\SingleSubjectTestTable;
use App\Models\AttemptSetting;
use App\Models\AttemptSettingsResult;
use App\Models\GroupPlan;
use App\Models\Question;
use App\Models\SingleSubjectTest;
use App\Models\SubCategory;
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
    const SETTINGS_TYPE=4;

    public function get_questions_with_subjects($subjects,$locale_id,$attempt_type_id,$single_q_count =0, $contextual_q_count =0, $multiple_q_count = 0){
        try {
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
        catch (\Exception $exception){
            throw new QuestionException($exception->getMessage());
        }

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

    public function get_max_time_in_ms($questions){
        $time = 0;
        foreach ($questions as $key=> $question){
            $subject = SingleSubjectTest::find($key);
            $time += ($subject->allotted_time * 60000);
        }
        return $time;
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
            $hidden = QuestionService::getHidden($type_id);
            $questions[$compulsory_subject->id] = [];
            if($single_q_count > 0){
                $questions_one = $this->get_single_questions($locale_id,$compulsory_subject,$single_q_count,$hidden);
                array_push($questions[$compulsory_subject->id],...$questions_one);
            }
            if($contextual_q_count > 0){
                if($contextual_q_count%self::CONTEXT_QUESTION_NUMBER){
                    throw new QuestionException("Контекстных Вопросов в дисциплине {$compulsory_subject->title_ru} недостаточно");
                }
                $context_questions = $this->get_context_questions($locale_id,$compulsory_subject,$contextual_q_count/self::CONTEXT_QUESTION_NUMBER,$hidden);
                array_push($questions[$compulsory_subject->id],...$context_questions);
            }
            if($multiple_q_count > 0){
                $multiple_question = $this->get_multiple_questions($locale_id,$compulsory_subject,$multiple_q_count,$hidden);
                array_push($questions[$compulsory_subject->id],...$multiple_question);
            }
        }
        return $questions;
    }


    protected function get_single_questions($locale_id,$compulsory_subject,$count,$hidden,$category_id=null,$sub_category_id=null){
        $condition = ["subject_id" => $compulsory_subject->id,"type_id" => self::SINGLE_QUESTION_ID,"locale_id" => $locale_id];
        $query = Question::query();
        if($category_id && !$sub_category_id){
            $sub_category_ids = SubCategory::where(["category_id" => $category_id])->pluck("id","id")->toArray();
            $query->whereIn("sub_category_id",$sub_category_ids)->with("context")->where($condition);
        }
        elseif (!$category_id && $sub_category_id){
            $condition["sub_category_id"] = $sub_category_id;
            $query->with("context")->where($condition);
        }
        else{
            $query->with("context")->where($condition);
        }
        $single_question_query = $query->inRandomOrder();
        $questions_one = $single_question_query->take($count)->get()->makeHidden($hidden)->toArray();
        return $questions_one;
    }

    protected function get_context_questions($locale_id,$compulsory_subject,$rand_int,$hidden,$category_id=null,$sub_category_id=null){
        $condition = ["type_id"=>self::CONTEXT_QUESTION_ID,"subject_id" => $compulsory_subject->id,"locale_id" => $locale_id];
        $query = Question::query();
        $context_questions = [];
        if($category_id && !$sub_category_id){
            $sub_category_ids = SubCategory::where(["category_id" => $category_id])->pluck("id","id")->toArray();
            $context_question = $query->whereIn("sub_category_id",$sub_category_ids)->where($condition)->with("context")->get()->take($rand_int * self::CONTEXT_QUESTION_NUMBER)->makeHidden($hidden)->toArray();
            array_push($context_questions, ...$context_question);
        }
        elseif (!$category_id && $sub_category_id){
            $condition["sub_category_id"] = $sub_category_id;
            $context_question =$query->where($condition)->with("context")->get()->take($rand_int * self::CONTEXT_QUESTION_NUMBER)->makeHidden($hidden)->toArray();;
            array_push($context_questions, ...$context_question);
        }
        else{
            $query->where($condition);
            $questions = $query->select("context_id",DB::raw('COUNT(questions.context_id) as context_qty'))->groupBy("context_id")->having(DB::raw('count(context_id)'), '=', 5)->pluck("context_qty","context_id")->toArray();
            if(count($questions)>=$rand_int){
                $ids = array_rand($questions,$rand_int);
                $ids = is_array($ids) ? $ids : [$ids];
                foreach ($ids as $id){
                    $context_question = Question::whereIn("context_id",[$id])->with("context")->get()->take(5)->makeHidden($hidden)->toArray();
                    array_push($context_questions, ...$context_question);
                }
            }
            else{
                throw new QuestionException("Вопросов в дисциплине {$compulsory_subject->title_ru} недостаточно");
            }
        }
        return $context_questions;

    }
    protected function get_multiple_questions($locale_id,$compulsory_subject,$count,$hidden,$category_id=null,$sub_category_id=null){
        $condition = ["subject_id" => $compulsory_subject->id,"type_id" => self::MULTI_QUESTION_ID,"locale_id" => $locale_id];
        $query = Question::query();
        if($category_id && !$sub_category_id){
            $sub_category_ids = SubCategory::where(["category_id" => $category_id])->pluck("id","id")->toArray();
            $query->with("context")->whereIn("sub_category_id",$sub_category_ids)->where($condition);
        }
        elseif (!$category_id && $sub_category_id){
            $condition["sub_category_id"] = $sub_category_id;
            $query->with("context")->where($condition);
        }
        else{
            $query->with("context")->where($condition);
        }
        $multiple_question_query = $query->inRandomOrder();
        $multiple_question = $multiple_question_query->take($count)->get()->makeHidden($hidden)->toArray();
        return $multiple_question;
    }



    protected function get_groups(int $attempt_type_id){
        //1 Check User Available Status free or premium (Plan Id)
        $plan_ids = auth()->guard("api")->user()->activeSubscriptions()->pluck("plan_id","plan_id");
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
            throw new QuestionException("Выберите предметы для сдачи тестирования!");
        }
        $subject_ids = [];
        if($attempt_type_id == QuestionService::UNT_TYPE){
            $compulsory_subjects = Subject::where(["is_compulsory"=>true])->pluck("id","id");
            array_push($subject_ids,...$compulsory_subjects);
        }
        array_push($subject_ids,...$subjects);
        if($attempt_type_id == QuestionService::UNT_TYPE){
            if(count($subject_ids) != 5){
                throw new QuestionException("Недостаточно предметов для сдачи тестирования!");
            }
        }
        $subjects =  Subject::whereIn("id",$subject_ids)->get();
        if(count($subjects) == 0){
            throw new QuestionException("Недостаточно предметов для сдачи тестирования!");
        }
        return $subjects;
    }

    public static function getHidden($type_id,$attempt_id = null):array{
        $hidden = [];
        if($type_id == QuestionService::UNT_TYPE || $type_id == QuestionService::CASUAL_TYPE){
            $hidden = ["correct_answers","explanation","explanation_image",];
        }
        else if($type_id == QuestionService::TOURNAMENT_TYPE){
            $hidden = ["correct_answers","explanation","prompt","explanation_image"];
        }
        else if($type_id == QuestionService::SETTINGS_TYPE){
            if($attempt_id){
                $attempts_res = AttemptSettingsResult::where(["attempt_id" => $attempt_id])->first();
                if($attempts_res){
                    $attempt_settings = AttemptSetting::firstWhere(["id"=>$attempts_res]);
                    $hidden = ["correct_answers","explanation","explanation_image",...explode(",",$attempt_settings->hidden)];
                }
                else{
                    $hidden = ["correct_answers","explanation","prompt","explanation_image"];
                }
            }
            else{
                $hidden = ["correct_answers","explanation","prompt","explanation_image"];
            }
        }
        return  $hidden;
    }



    public function getQuestionBySettingsId($setting_id){
        $attempt_settings = AttemptSetting::with("subject")->find($setting_id);
        if(!$attempt_settings){
            throw new NotFoundException("Не найдены настройки");
        }
        $hidden_fields = explode(",",$attempt_settings->hidden_fields);
        $hidden = ["correct_answers","explanation","explanation_image",...$hidden_fields];
        $questions[$attempt_settings->subject_id] = [];
        $settings = json_decode($attempt_settings->settings,true);
        foreach ($settings as $category_id => $setting){
            if($settings[$category_id]){
                //Есть ли Суб Категория
                if(key_exists("sub_category_ids",$setting)){
                    foreach ($setting["sub_category_ids"] as $sub_category_id => $question_quantity){
                        $s_questions = key_exists("s_questions",$question_quantity) ? $question_quantity["s_questions"] : 0;
                        if($s_questions){
                            $questions_one = $this->get_single_questions($attempt_settings->locale_id,$attempt_settings->subject,$s_questions,$hidden,null,$sub_category_id);
                            array_push( $questions[$attempt_settings->subject_id],...$questions_one);
                        }
                        $c_questions = key_exists("c_questions",$question_quantity) ? $question_quantity["c_questions"] : 0;
                        if($c_questions){
                            $context_questions = $this->get_context_questions($attempt_settings->locale_id,$attempt_settings->subject,$c_questions/self::CONTEXT_QUESTION_NUMBER,$hidden,null,$sub_category_id);
                            array_push($questions[$attempt_settings->subject_id],...$context_questions);
                        }
                        $m_questions = key_exists("m_questions",$question_quantity) ? $question_quantity["m_questions"] : 0;
                        if($m_questions){
                            $multiple_question = $this->get_multiple_questions($attempt_settings->locale_id,$attempt_settings->subject,$m_questions,$hidden,null,$sub_category_id);
                            array_push($questions[$attempt_settings->subject_id],...$multiple_question);
                        }
                    }
                }
                //Только Категория
                else{
                    $s_questions = key_exists("s_questions",$setting) ? $setting["s_questions"] : 0 ;
                    $c_questions = key_exists("c_questions",$setting) ? $setting["c_questions"] : 0;
                    $m_questions =  key_exists("m_questions",$setting) ? $setting["m_questions"] : 0;
                    if($s_questions){
                        $questions_one = $this->get_single_questions($attempt_settings->locale_id,$attempt_settings->subject,$s_questions,$hidden,$category_id,);
                        array_push( $questions[$attempt_settings->subject_id],...$questions_one);
                    }
                    if($c_questions){
                        $context_questions = $this->get_context_questions($attempt_settings->locale_id,$attempt_settings->subject,$c_questions/self::CONTEXT_QUESTION_NUMBER,$hidden,$category_id);
                        array_push($questions[$attempt_settings->subject_id],...$context_questions);
                    }
                    if($m_questions){
                        $multiple_question = $this->get_multiple_questions($attempt_settings->locale_id,$attempt_settings->subject,$m_questions,$hidden,$category_id);
                        array_push($questions[$attempt_settings->subject_id],...$multiple_question);
                    }
                }
            }
            else{
                throw new \Exception("Выберите верное количество");
            }
        }
        return $questions;
    }

    public function getFiftyFifty($question){
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
        return $correct_answer;
    }

    public function getSubCategoryQuestionNumber($sub_category_id,$locale_id){
        //disable ONLY_FULL_GROUP_BY
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $count = Question::where(["sub_category_id" => $sub_category_id,"locale_id" => $locale_id])
                            ->select("id","type_id",DB::raw('count(*) as question_total'))
                            ->groupBy(["type_id"])->pluck("question_total","type_id")->toArray();
        //re-enable ONLY_FULL_GROUP_BY
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        $result = [$sub_category_id => [
            "single_count"=>key_exists(self::SINGLE_QUESTION_ID,$count) ? $count[self::SINGLE_QUESTION_ID] : 0,
            "context_count"=>key_exists(self::CONTEXT_QUESTION_ID,$count) ? $count[self::CONTEXT_QUESTION_ID] : 0,
            "multiple_count"=>key_exists(self::MULTI_QUESTION_ID,$count) ? $count[self::MULTI_QUESTION_ID] : 0,
        ]];
        return $result;
    }

    public function getCategoryQuestionNumber($category_id,$locale_id){
        //disable ONLY_FULL_GROUP_BY
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $sub_category_ids = SubCategory::where(["category_id" => $category_id])->pluck("id","id")->toArray();
        $count = Question::whereIn("sub_category_id",$sub_category_ids)->where(["locale_id" => $locale_id])
            ->select("id","type_id",DB::raw('count(*) as question_total'))
            ->groupBy(["type_id"])->pluck("question_total","type_id")->toArray();
        //re-enable ONLY_FULL_GROUP_BY
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        $result = [$category_id => [
            "single_count"=>key_exists(self::SINGLE_QUESTION_ID,$count) ? $count[self::SINGLE_QUESTION_ID] : 0,
            "context_count"=>key_exists(self::CONTEXT_QUESTION_ID,$count) ? $count[self::CONTEXT_QUESTION_ID] : 0,
            "multiple_count"=>key_exists(self::MULTI_QUESTION_ID,$count) ? $count[self::MULTI_QUESTION_ID] : 0,
        ]];
        return $result;
    }


}
