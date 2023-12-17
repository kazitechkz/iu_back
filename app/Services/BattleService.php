<?php

namespace App\Services;

use App\DTOs\AnswerBattleQuestion;
use App\DTOs\BattleCreateDTO;
use App\DTOs\BattleStepCreateDTO;
use App\Events\BattleDetailEvent;
use App\Exceptions\BadRequestException;
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
    public const MAX_MINUTE_WAIT = 3;
    public const HIDDEN_FIELDS = ["correct_answers","explanation","prompt","explanation_image"];
    public function createBattle(BattleCreateDTO $battleCreateDTO) : Battle{
        $user = auth()->guard("api")->user();
        $input = $battleCreateDTO->toArray();
        if($user->balanceInt < $input["price"]){
            throw new BadRequestException("Недостаточно средств");
        }
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
        if($battle->owner_id !=$user->id){
            if($user->balanceInt < $battle->price){
                throw new BadRequestException("Недостаточно средств");
            }
            $battle->update(["guest_id"=>$user->id,"is_open"=>false]);
            $steps = $battle->battle_steps()->get();
            foreach ($steps as $step){
                if($step->current_user == null){
                    $step->edit(["current_user"=>$user->id]);
                }
            }
            return $battle;
        }
        else{
            throw new BadRequestException("Упс, игра не найдена");
        }
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
                    if(!$input["subject_id"]){
                        throw new BadRequestException("Выберите дисциплину!");
                    }
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
                throw new BadRequestException("Вы не участвуете в игре");
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
                throw new BadRequestException("Вы не участвуете в игре");
            }
            else{
                throw new BadRequestException("Вы не участвуете в игре");
            }
        }
        else{
            throw new BadRequestException("Игра не найдена");
        }
    }

    public static function checkBattle($battle_id){
        $battle = Battle::with(["battle_steps.battle_step_results","battle_steps.battle_step_questions"])->find($battle_id);
        if($battle){
            if(!$battle->is_finished){
                //Баллы
                $end_at = null;
                $common_owner_point =0;
                $common_guest_point = 0;
                //Пользовательские айди
                $owner_id = $battle->owner_id;
                $guest_id = $battle->guest_id;
                $battle_steps = $battle->battle_steps;
                $is_ended = false;
                $winner_id = null;
                $current_step = 0;
                foreach ($battle_steps as $battle_step){
                    //Баллы на каждом этапе
                    $point_owner = $battle_step->battle_step_questions()->where(["user_id"=>$owner_id])->sum("point");
                    $answered_owner = $battle_step->battle_step_questions()->where(["user_id"=>$owner_id,"is_answered"=>false])->count();
                    $point_guest = $battle_step->battle_step_questions()->where(["user_id"=>$guest_id])->sum("point");
                    $answered_guest = $battle_step->battle_step_questions()->where(["user_id"=>$guest_id,"is_answered"=>false])->count();
                    //Пересчитаем Результаты
                    //Проверяем Текущий этап
                    if($battle_step->is_current){
                        $current_step = $battle_step->order;
                        $owner_battle_result = BattleStepResult::where(["step_id" => $battle_step->id,"answered_user"=>$owner_id])->first();
                        $guest_battle_result = BattleStepResult::where(["step_id" => $battle_step->id,"answered_user"=>$guest_id])->first();
                        if($owner_battle_result){
                            $owner_battle_result->edit(["result"=>$point_owner]);
                            if(($answered_owner == 0 && !$owner_battle_result->is_finished) || (Carbon::parse($owner_battle_result->start_at)->addMinute(self::MAX_MINUTE_WAIT) < Carbon::now() && !$owner_battle_result->is_finished)){
                                $owner_battle_result->edit(["is_finished"=>true,"end_at"=>Carbon::now()]);
                                broadcast(new BattleDetailEvent($battle->promo_code,"refresh"));
                                //Значит до меня уже сдавали
                                if($guest_battle_result){
                                    if($battle_step->order < 4){
                                        $battle_step->edit(["is_current"=>false,"current_user"=>null]);
                                        $current_step = $battle_step->order+ 1;
                                    }
                                    else{
                                        $is_ended = true;
                                    }
                                }
                                //До меня не сдавали
                                else{
                                    $battle_step->edit(["current_user"=>$guest_id]);
                                }
                            }
                        }
                        if($guest_battle_result){
                            $guest_battle_result->edit(["result"=>$point_guest]);
                            if(($answered_guest == 0 && !$guest_battle_result->is_finished) || (Carbon::parse($guest_battle_result->start_at)->addMinute(self::MAX_MINUTE_WAIT) < Carbon::now() && !$guest_battle_result->is_finished)){
                                $guest_battle_result->edit(["is_finished"=>true,"end_at"=>Carbon::now()]);
                                broadcast(new BattleDetailEvent($battle->promo_code,"refresh"));
                                if($owner_battle_result){
                                    if($battle_step->order < 4){
                                        $battle_step->edit(["is_current"=>false,"current_user"=>null]);
                                        $current_step = $battle_step->order + 1;
                                    }
                                    else{
                                        $is_ended = true;
                                    }
                                }
                                //До меня не сдавали
                                else{
                                    $battle_step->edit(["current_user"=>$owner_id]);
                                }
                            }
                        }
                    }
                    if($battle_step->order == $current_step){
                        $battle_step->edit(["is_current"=>true]);
                    }
                    //Battle Common Result
                    $common_owner_point += $point_owner;
                    $common_guest_point += $point_guest;
                }
                if($battle->must_finished_at < Carbon::now()){
                    $is_ended = true;
                }
                if($is_ended){

                    if($common_owner_point > $common_guest_point){
                        $winner_id = $battle->owner_id;
                    }
                    if($common_owner_point < $common_guest_point){
                        $winner_id = $battle->guest_id;
                    }
                    $battle->battle_steps()->update(["current_user"=>null,"is_current"=>false]);
                    broadcast(new BattleDetailEvent($battle->promo_code,"refresh_winner"));
                    $end_at = Carbon::now();
                }
                $battle->edit(["owner_point"=>$common_owner_point,"guest_point"=>$common_guest_point,"winner_id"=>$winner_id,"is_finished"=>$is_ended,"end_at"=>$end_at]);
            }

        }
    }

    //Check Answer
    public function checkAnswer(AnswerBattleQuestion $answer){
        $user = auth()->guard("api")->user();
        $input = $answer->toArray(); //$battle_step_id $answer $question_id;
        $battleStep = BattleStep::where(['id'=>$input["battle_step_id"],"current_user" => $user->id,"is_current" => true])
                                ->with("battle_step_results")
                                ->first();
        if($battleStep){
            $result = ["is_right"=>false,"point"=>0];
            //Проверяем не истекло ли время у результата
            $battleResult = BattleStepResult::where(["step_id" => $battleStep->id,"answered_user"=>$user->id,"is_finished"=>false])->first();
            if(!$battleResult){
                throw new BadRequestException("Результат не найден!");
            }
            $battleStepQuestion = BattleStepQuestion::where(["user_id"=>$user->id,"question_id" => $input["question_id"],"step_id" => $input["battle_step_id"]])->with(["question"])->first();
            if(!$battleStepQuestion){
                throw new BadRequestException("Вопрос не найден!");
            }
            $question = $battleStepQuestion->question()->first();
            if(!$battleStepQuestion->is_answered){
                    //Подсчитаем баллы
                    $answers = strtolower($input["answer"]);
                    $service = new AnswerService();
                    $result = $service->check_answer($input["question_id"],$answers);
                    $battleStepQuestion->edit([...$result,"is_answered"=>true,"answer"=>$answers,"right_answer"=>$question->correct_answers]);
            }
            self::checkBattle($battleStep->battle_id);
            $newBattleResult = BattleStepResult::where(["step_id"=>$battleStep->id,"answered_user"=>$user->id,])->first();
            if($newBattleResult){
                $nextBattleStep = BattleStep::where(["battle_id" => $battleStep->battle_id,"is_current" => true,"current_user" => $user->id])->where("id","!=",$battleStep->id)->first();
            }
            $battle = $battleStep->battle()->first();
            $questions_result = BattleStepQuestion::where(["step_id" => $battleStep->id,"user_id"=>$user->id])->orderBy("question_id","ASC")->get()->toArray();
            return [
                ...$result,
                "question_id"=>$input["question_id"],
                "battle_id"=>$battleStep->battle_id,
                "battle_step_id"=>$battleStep->id,
                "battle_promo_code"=>$battle->promo_code,
                "result"=>$questions_result,
                "given_answer"=>strtolower($input["answer"]),
                "correct_answer"=>$question->correct_answers,
                "is_finished"=> $newBattleResult ? $newBattleResult->is_finished : false,
                "next_step_id"=> $nextBattleStep->id ?? null
            ];
        }
        else{
            throw new BadRequestException("Этап не найден или пройден!");
        }
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
        $battleResult = BattleStepResult::where(["step_id" => $battleStep->id,"answered_user" => $user->id])->first();
        if(!$battleResult){
            $battleResult = BattleStepResult::add([
                'step_id'=>$battleStep->id,
                'answered_user'=>$user->id,
                'start_at'=>Carbon::now(),
                'is_finished'=>false,
                'must_finished_at'=>Carbon::now()->addSeconds(30)
            ]);
        }
        $battle = $battleStep->battle()->first();
        $time_left = Carbon::now()->diffInSeconds($battleResult->must_finished_at);
        $time_left_seconds = $time_left > 0 ? $time_left : 0;
        $answered_questions = BattleStepQuestion::where(["step_id" => $battleStep->id,"user_id"=>$user->id,"is_answered"=>true])->pluck("question_id")->toArray();
        $questions_result = BattleStepQuestion::where(["step_id" => $battleStep->id,"user_id"=>$user->id])->orderBy("question_id","ASC")->get()->toArray();
        $questions = Question::whereIn("id",$battle_questions)->with(["context"])->orderBy("id","ASC")->get()->makeHidden(self::HIDDEN_FIELDS)->toArray();
        $result = ["battle_step_id"=>$battleStep->id,"battle_id"=>$battleStep->battle_id, "battle_promo_code"=>$battle->promo_code,"result"=>$questions_result,"answered_questions"=>$answered_questions,"time_left_seconds"=>$time_left_seconds,"questions"=>[...$questions]];
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
