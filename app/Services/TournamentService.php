<?php

namespace App\Services;

use App\Exceptions\AnswerException;
use App\Exceptions\ApiValidationException;
use App\Exceptions\TournamentException;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\SubTournamentResult;
use App\Models\SubTournamentRival;
use App\Models\SubTournamentWinner;
use App\Models\Tournament;
use App\Models\TournamentAward;
use App\Models\TournamentPrize;
use App\Models\TournamentStep;
use App\Models\TournamentWinner;
use App\Models\User;
use Illuminate\Support\Carbon;
class TournamentService{



    public function create_sub_tournament($data){
        try{
            $tournament_id = $data["tournament_id"];
            $step_id = $data["step_id"];
            //First step check the step_id and is it first or last
            $step = TournamentStep::find($step_id);
            if($step == null){
                throw new \Exception("Этапы должны существовать");
            }
            $input = $this->prepare_data($data);
            //Check if sub_tournaments exist
            if((SubTournament::where(["step_id" => $step_id,"tournament_id" => $tournament_id])->count()) == 0){
                if($step->is_first){
                    SubTournament::add($input);
                }
                else{
                    //Теперь выберем победителей и определим игроков следующего этапа
                    //Check if previous step exists in sub_tournament
                    $prev_sub_tournament = SubTournament::where(["tournament_id" => $tournament_id,"step_id" => $step->prev_id])->first();
                    //So it doesnt exist
                    if(!$prev_sub_tournament){
                        throw new TournamentException("Создайте предыдущий этап");
                    }
                    $this->choose_winners($step,$tournament_id,$input);
                }
            }
            // if is null the step must be isFirst or it doesn`t exists
            else{
                throw new TournamentException("Этап уже существует");
            }
        }
        catch (\Exception $exception){
            throw new TournamentException($exception->getMessage());
        }

    }

    protected function prepare_data($data){
        $input = $data;
        $input["question_quantity"] =
            $data["single_question_quantity"] +
            $data["multiple_question_quantity"] +
            $data["context_question_quantity"];
        $input["max_point"] =
            $data["single_question_quantity"] +
            $data["multiple_question_quantity"] * 2 +
            $data["context_question_quantity"];
        $input["start_at"] = Carbon::parse($input["start_at"]);
        $input["end_at"] = Carbon::parse($input["end_at"]);
        $input["is_current"] = true;
        $input["is_finished"] = false;
        return $input;
    }


    protected function choose_winners(TournamentStep $step,$tournament_id,$data){
        $prev_step = TournamentStep::find($step->prev_id);
        $prev_sub_tournament = SubTournament::where(["tournament_id" => $tournament_id,"step_id" =>$prev_step->id])->first();
        if($prev_step->is_playoff){
            $winners = SubTournamentRival::where(["sub_tournament_id" => $prev_sub_tournament->id])->where("winner","!=",null)->pluck("winner","winner")->toArray();
        }
        else{
            $winners = SubTournamentResult::where(["sub_tournament_id" => $prev_sub_tournament->id])->orderBy("point","DESC")->orderBy("time","DESC")->take($step->max_participants)->pluck("user_id","user_id")->toArray();
        }
        if(count($winners) != $step->max_participants){
            throw new TournamentException("Участников для перехода на следующий уровень недостаточно");
        }
        if($step->is_playoff){
            $play_off_diff = [];
            $play_off_participants = [];
            if(count($winners)%2 != 0){
                throw new TournamentException("Участников для перехода на следующий уровень недостаточно");
            }
            for ($i = 0;$i<count($winners)/2;$i++){
                $random_participants = array_rand(array_diff($winners,$play_off_diff),2);
                array_push($play_off_diff,...$random_participants);
                $play_off_participants[$i] = $random_participants;
            }
            if(count($play_off_participants) != $step->max_participants/2){
                throw new TournamentException("Участников для перехода на следующий уровень недостаточно");
            }
        }
        $random_participants = array_rand($winners,2);
        //Определяем следующий этап
        $i = 0;
        $prev_sub_tournament->edit(["is_finished"=>true,"is_current"=>false]);
        $sub_tournament = SubTournament::add($data);
        foreach ($winners as $winner){
            //Определяем победителей прошлого этапа
            SubTournamentWinner::add(["user_id"=>$winner,"sub_tournament_id"=>$prev_sub_tournament->id]);
            SubTournamentParticipant::add(['user_id' => $winner, 'sub_tournament_id' => $sub_tournament->id, 'status' => 1]);
        }
        $raw_data = [];
        if($step->is_playoff){
            foreach ($play_off_participants as $participant){
                array_push($raw_data,[
                    'rival_one' => $participant[0],
                    'point_one' => 0,
                    'time_one' => $sub_tournament->time * 60000,
                    'rival_two' => $participant[1],
                    'point_two' => 0,
                    'time_two' => $sub_tournament->time * 60000,
                    'winner' => null,
                    'sub_tournament_id' => $sub_tournament->id
                ]);
            }
            SubTournamentRival::insert($raw_data);
        }
    }


    public function participate($user_id, $sub_tournament_id, bool $payFrom = false)
    {
        $sub_tournament = SubTournament::find($sub_tournament_id);
        if (!$sub_tournament) {
            throw new TournamentException("Этап Турнира не существует");
        }
        if ($sub_tournament->is_finished || !$sub_tournament->is_current) {
            throw new TournamentException("Этап турнира прошел");
        }
        if (($sub_tournament->start_at < Carbon::now()) && (Carbon::now() < $sub_tournament->end_at)) {
            if (SubTournamentParticipant::where(["user_id" => $user_id, "sub_tournament_id" => $sub_tournament_id,])->first()) {
                if (!$payFrom) {
                    throw new TournamentException("Вы уже участвовали в турнире");
                }
            } else {
                SubTournamentParticipant::add(["user_id" => $user_id, "sub_tournament_id" => $sub_tournament_id, "status" => 1,"created_at"=>Carbon::now(),"updated_at"=>Carbon::now()]);
            }
        } else {
            throw new TournamentException("Дата турнира прошла");
        }
    }



    public function get_questions($user_id,$sub_tournament_id,$locale_id){
        //First of all we check
        //1. If Current Sub_Tournament_Exist and User is Participant and if user doesnt have result
        $sub_tournament = SubTournament::find($sub_tournament_id);
        $participant = SubTournamentParticipant::where(["user_id" => $user_id,"sub_tournament_id" => $sub_tournament->id])->first();
        if(!$participant){
            throw new \Exception("Вы не являетесь участником");
        }
        $sub_tournament_result = SubTournamentResult::where(["sub_tournament_id" => $sub_tournament_id,"user_id" => $user_id])->first();
        if($sub_tournament_result){
            throw new \Exception("Вы уже сдали данный этап");
        }
        //2 Now create attempt
         $tournament = Tournament::where(["id"=>$sub_tournament->tournament_id])->first();
        if(!$tournament){
            throw new \Exception("Данный турнир не существует");
        }
        $question_service = new QuestionService();
        $questions = [];
        //Get Subject
        $subject = Subject::where(["id"=>$tournament->subject_id])->pluck("id");
        //Now get questions
        $questions = $question_service->get_questions_with_subjects(
            subjects: [...$subject],
            locale_id: $locale_id,
            attempt_type_id: QuestionService::TOURNAMENT_TYPE,
            single_q_count: $sub_tournament->single_question_quantity,
            contextual_q_count: $sub_tournament->context_question_quantity,
            multiple_q_count: $sub_tournament->multiple_question_quantity
            );
        $count_question = $question_service->get_questions_max_point($questions);
        $attempt_service = new AttemptService();
        $attempt = $attempt_service->create_attempt($user_id,QuestionService::TOURNAMENT_TYPE,$locale_id,$count_question,$questions,$sub_tournament->time*60000);
        SubTournamentResult::add([
            'user_id' => $user_id,
            'sub_tournament_id' => $sub_tournament_id,
            'point' => 0,
            'time' => $sub_tournament->time * 60000,
            'attempt_id' => $attempt
        ]);
        return $attempt;
    }


    public function givePrize($id){
        $tournament = Tournament::with("sub_tournaments")->find($id);
        //Sub Steps
        $final_sub = $tournament->sub_tournaments()->where(["step_id"=>4])->first();
        $half_final_sub = $tournament->sub_tournaments()->where(["step_id"=>3])->first();
        $fourth_final_sub = $tournament->sub_tournaments()->where(["step_id"=>2])->first();
        $first_sub = $tournament->sub_tournaments()->where(["step_id"=>1])->first();
        $winner = TournamentWinner::where(["tournament_id" => $tournament->id])->first();
        $second_winner = SubTournamentParticipant::where(["sub_tournament_id" => $final_sub->id])->where("user_id","!=",$winner->winner_id)->first();
        $third_winners = SubTournamentParticipant::where(["sub_tournament_id" => $half_final_sub->id])->whereNotIn("user_id",[$winner->winner_id,$second_winner->user_id])->pluck("user_id")->toArray();
        $fourth_winners = SubTournamentParticipant::where(["sub_tournament_id" => $fourth_final_sub->id])->whereNotIn("user_id",[$winner->winner_id,$second_winner->user_id,...$third_winners])->pluck("user_id")->toArray();
        $results = [];
        for ($i=1;$i <= 4;$i++){
            $prize = TournamentPrize::where(["tournament_id" => $id,"order"=>$i])->first();
            if($i == 1){
                $results[] = [
                    'title_ru'=>$prize->title_ru,
                    'title_kk'=>$prize->title_kk,
                    'title_en'=>$prize->title_en,
                    'is_awarded'=>false,
                    'tournament_id'=>$id,
                    'sub_tournament_id'=>$final_sub->id,
                    'user_id'=>$winner->winner_id,
                    'order'=>$prize->order
                ];
            }
            if($i == 2){
                $results[] = [
                    'title_ru'=>$prize->title_ru,
                    'title_kk'=>$prize->title_kk,
                    'title_en'=>$prize->title_en,
                    'is_awarded'=>false,
                    'tournament_id'=>$id,
                    'sub_tournament_id'=>$half_final_sub->id,
                    'user_id'=>$second_winner->user_id,
                    'order'=>$prize->order
                ];
            }
            if($i == 3){
                foreach ($third_winners as $winner_id){
                    $results[] = [
                        'title_ru'=>$prize->title_ru,
                        'title_kk'=>$prize->title_kk,
                        'title_en'=>$prize->title_en,
                        'is_awarded'=>false,
                        'tournament_id'=>$id,
                        'sub_tournament_id'=>$fourth_final_sub->id,
                        'user_id'=>$winner_id,
                        'order'=>$prize->order
                    ];
                }
            }
            if($i == 4){
                foreach ($fourth_winners as $winner_id){
                    $results[] = [
                        'title_ru'=>$prize->title_ru,
                        'title_kk'=>$prize->title_kk,
                        'title_en'=>$prize->title_en,
                        'is_awarded'=>false,
                        'tournament_id'=>$id,
                        'sub_tournament_id'=>$first_sub->id,
                        'user_id'=>$winner_id,
                        'order'=>$prize->order
                    ];
                }
            }
        }
        $exclude_users = [$winner->winner_id,$second_winner->user_id,...$third_winners,...$fourth_winners];
        $reminders = TournamentPrize::where(["tournament_id" => $id,"order"=>null])->orderBy("start_from","ASC")->get();
        $order_id = 5;
        foreach ($reminders as $reminder){
            $takes = $reminder->end_to - $reminder->start_from;
            $remind_users = SubTournamentResult::where(["sub_tournament_id" => $first_sub->id])
                ->whereNotIn("user_id",$exclude_users)
                ->orderBy("point","DESC")->orderBy("time","DESC")->get()->take($takes)->pluck("user_id")->toArray();
            foreach ($remind_users as $remind_user){
                $results[] = [
                    'title_ru'=>$reminder->title_ru,
                    'title_kk'=>$reminder->title_kk,
                    'title_en'=>$reminder->title_en,
                    'is_awarded'=>false,
                    'tournament_id'=>$id,
                    'sub_tournament_id'=>$first_sub->id,
                    'user_id'=>$remind_user,
                    'order'=>$order_id
                ];
                $order_id++;
                $exclude_users[] = $remind_user;
                if($reminder->is_virtual){
                    $user = User::find($remind_user);
                    if($user){
                        $user->deposit($reminder->value);
                    }
                }
            }
        }
        TournamentAward::insert($results);
    }








}
