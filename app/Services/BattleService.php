<?php

namespace App\Services;

use App\DTOs\AnswerBattleQuestion;
use App\DTOs\BattleCreateDTO;
use App\DTOs\BattleStepCreateDTO;
use App\Models\Battle;
use App\Models\BattleStep;
use App\Models\BattleStepQuestion;
use App\Models\BattleStepResult;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BattleService
{
    public const STEPS = [1,2,3,4];
    public const OWNER_STEPS = [1,3];
    public const GUEST_STEPS = [2,4];
    public const FIRST_STEP = 1;
    public const LAST_STEP = 4;
    public const HIDDEN_FIELDS = ["correct_answers","explanation","prompt","explanation_image"];
    public function createBattle(BattleCreateDTO $battleCreateDTO) : Battle{
        $user = auth()->guard("api")->user();
        $input = $battleCreateDTO->toArray();
        $input["owner_id"] = $user->id;
        $input["promo_code"] = self::generatePromoCode("battle");
        $input["is_open"] = true;
        $input["start_at"] = Carbon::now();
        $input["must_finished_at"] = Carbon::now()->addHour();
        if($input["pass_code"]){
            $input["pass_code"] = bcrypt($input["pass_code"]);
        }
        $battle = Battle::add($input);
        foreach (self::STEPS as $STEP){
            $promo_code = self::generatePromoCode("battle_step");
            $input = [
                'promo_code'=>$promo_code,
                'battle_id'=>$battle->id,
                'subject_id'=>null,
                'current_user'=>null,
                'is_finished'=>false,
                'is_current'=>false,
                'is_last'=>false,
                'order'=>$STEP
            ];
            if(in_array($STEP,self::OWNER_STEPS)){
                $input["current_user"] = $user->id;
            }
            if($STEP == self::FIRST_STEP){
                $input["is_current"] = true;
            }
            if($STEP == self::LAST_STEP){
                $input["is_last"] = true;
            }
            $battle_step = BattleStep::add($input);
        }
        return $battle;
    }

    public function joinToBattle(Battle $battle){
        $user = auth()->guard("api")->user();
        $battle->update(["guest_id"=>$user->id,"is_open"=>false]);
        $steps = $battle->battle_steps();
        foreach ($steps as $step){
            if(in_array($step->order,self::GUEST_STEPS)){
                $step->edit(["current_user"=>$user->id]);
            }
        }
        return $battle;
    }


    //Создаем этап битвы и возвращаем новую модель с вопросами
    public function createBattleStep(BattleStepCreateDTO $battleStepCreateDTO){
        $user = auth()->guard("api")->user();
        $input = $battleStepCreateDTO->toArray();//subject_id,battle_step_id
        //Проверяем его ли очередь на текущий момент
        $battleStep = BattleStep::where(["id"=>$input["battle_step_id"],"is_current" => true,"current_user"=>$user->id])->with(["battle","battle_step_results"])->first();
        //Проверяем есть ли текущий раунд

        if($battleStep){
            if($old_questions = BattleStepQuestion::where(["step_id" => $battleStep->id,"user_id"=>$user->id])->pluck("question_id","question_id")->toArray()){
                if(count($old_questions)){
                    return self::getBattleStepQuestions($user,$old_questions,$battleStep);
                }
            }

            //Проверяем кто он гость или владелец
            $battle = $battleStep->battle;
            //Если владелец
            if($battle->owner_id == $user->id){
                //Смотрим чей черед задавать и генерировать вопросы
                if(in_array($battleStep->order,self::OWNER_STEPS)){
                    //Задаем этапу вопросы
                    $battleStep->subject_id = $input["subject_id"];
                    $battleStep->update(["subject_id"=>$input["subject_id"]]);
                    //Вопросы
                    $questions = Question::where(["subject_id"=>$input["subject_id"],"type_id" => QuestionService::SINGLE_QUESTION_ID,"locale_id" => $battle->locale_id])
                        ->inRandomOrder()->take(3)->get()->pluck("id","id")->toArray();
                    return self::getBattleStepQuestions($user,$questions,$battleStep);

                }
                //Значит вопросы создавал пользователь ранее
                else{
                    $questions = BattleStepQuestion::where(["step_id" => $battleStep->id])->pluck("question_id","question_id")->toArray();
                    return self::getBattleStepQuestions($user,$questions,$battleStep);
                }
                throw new \Exception("Вы не участвуете в игре");
            }
            //Если гость
            elseif ($battle->guest_id == $user->id){
                //Смотрим чей черед задавать и генерировать вопросы
                    if(in_array($battleStep->order,self::GUEST_STEPS)){
                    //Задаем этапу вопросы
                    $battleStep->subject_id = $input["subject_id"];
                    $battleStep->update(["subject_id"=>$input["subject_id"]]);
                    //Вопросы
                    $questions = Question::where(["subject_id"=>$input["subject_id"],"type_id" => QuestionService::SINGLE_QUESTION_ID,"locale_id" => $battle->locale_id])
                        ->inRandomOrder()->take(3)->get()->pluck("id","id")->toArray();
                    return self::getBattleStepQuestions($user,$questions,$battleStep);

                }
                //Значит вопросы создавал пользователь ранее
                else{
                    $questions = BattleStepQuestion::where(["step_id" => $battleStep->id])->pluck("question_id","question_id")->toArray();
                    return self::getBattleStepQuestions($user,$questions,$battleStep);
                }
                throw new \Exception("Вы не участвуете в игре");
            }
            else{
                throw new \Exception("Вы не участвуете в игре");
            }
        }
        else{
            throw new \Exception("Игра не найдена");
        }
    }

    //Check Answer
    public function checkAnswer(AnswerBattleQuestion $answer,BattleStepResult $battleStepResult){
        $user = auth()->guard("api")->user();
        $input = $answer->toArray(); //$battle_step_id $answer $question_id;
        $answers = strtolower($input["answer"]);
        $service = new AnswerService();
        $result = $service->check_answer($input["question_id"],$answers);
        //После проверки баллов необходимо
        //Засчитать его
        $battleStepQuestion = BattleStepQuestion::where(["user_id"=>$user->id,"question_id" => $input["question_id"],"step_id" => $input["battle_step_id"]])->with(["question"])->first();
        //Подсчитаем баллы
        $battleStepQuestion->edit([...$result,"is_answered"=>true]);
        //Подсчитаем баллы

    }


    public static function countPointsByBattleStepId($step_id,$user){
        $battleStep = BattleStep::where(["id"=>$step_id])->with(["battle","battle_step_questions"])->first();
        $battle = $battleStep->battle;
        $battleResult = BattleStepResult::where(["step_id" => $step_id,"answered_user" => $user->id])->first();
        $battleQuestions = $battleStep->battle_step_questions->where(["user_id"=>$user->id])->get();
        $is_finished = false;
    }



    //Генерирую вопросы
    public static function getBattleStepQuestions($user,$questions,$battleStep){
        $battle_questions = [];
        foreach ($questions as $question){
            if(!BattleStepQuestion::where(["question_id" => $question,"user_id"=>$user->id,"step_id" => $battleStep->id])->exists()){
                $battleStepQuestion = BattleStepQuestion::add([
                        'step_id' => $battleStep->id,
                        'question_id' => $question,
                        'user_id'=>$user->id
                    ]
                );
            }
            array_push($battle_questions,$question);
        }
        //Создаем результат
        if(!BattleStepResult::where(["step_id" => $battleStep->id,"answered_user" => $user->id])->exists()){
            $battleResult = BattleStepResult::add([
                'step_id'=>$battleStep->id,
                'answered_user'=>$user->id,
                'start_at'=>Carbon::now(),
                'is_finished'=>false,
            ]);
        }
        $questions = Question::whereIn("id",$battle_questions)->get()->makeHidden(self::HIDDEN_FIELDS)->toArray();
        $result = ["battle_step_id"=>$battleStep->id,"questions"=>[...$questions]];
        return $result;
    }
    //Генерирует Промо Код
    public static function generatePromoCode($type){
        $battle_type = $type;
        $result = Str::random(10);
        if($type == "battle"){
            if(Battle::where(["promo_code" => $result])->first()){
                return self::generatePromoCode($battle_type);
            }
            return $result;
        }
        elseif ($type == "battle_step"){
            if(BattleStep::where(["promo_code" => $result])->first()){
                return self::generatePromoCode($battle_type);
            }
            return $result;
        }
    }
}
