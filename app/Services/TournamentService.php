<?php

namespace App\Services;

use App\Models\Step;
use App\Models\Subject;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\SubTournamentResult;
use App\Models\Tournament;
use App\Models\TournamentStep;
use Illuminate\Support\Carbon;

class TournamentService{



    public function create_sub_tournament($data){
        $tournament_id = $data["tournament_id"];
        $step_id = $data["step_id"];
        $single_question_quantity = $data["single_question_quantity"];
        $multiple_question_quantity = $data["multiple_question_quantity"];
        $context_question_quantity = $data["context_question_quantity"];
        $time = $data["time"];
        $start_at = $data["start_at"];
        $end_at = $data["start_at"];

        //First step check the step_id and is it first or last
        $step = TournamentStep::find($step_id);
        if($step == null){
            throw new \Exception("Этап должны существовать");
        }
        //Check if sub_tournaments exist
        if((SubTournament::where(["step_id" => $step_id,"tournament_id" => $tournament_id])->count()) == 0){
            //Check if previous step exists in sub_tournament
            $prev_sub_tournament = SubTournament::where(["tournament_id" => $tournament_id,"step_id" => $step->prev_id])->first();
            //So it doesnt exist
            if(!$prev_sub_tournament){
                throw new \Exception("Сначала выберите предыдущий этап");
            }
            //Теперь выберем победителей и определим игроков следующего этапа
            $this->choose_winners($step,$tournament_id);

        }
        // if is null the step must be isFirst or it doesn`t exists
        else{
            if(!$step->is_first){
                throw new \Exception("Сначала выберите первый этап");
            }
            else{
                //Alright it  exists
                $input = $this->prepareData($data);
                SubTournament::add($input);
            }

        }
    }

    protected function prepareData($data){
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
        return $input;
    }


    protected function choose_winners(TournamentStep $step,$tournament_id){
        $prev_step = TournamentStep::find($step->prev_id);
        if($step->is_playoff){
            if($prev_step->is_first){
                $sub_tournament = SubTournament::where(["tournament_id" => $tournament_id,"step_id" =>$prev_step->id])->first();
                dd(SubTournamentResult::where(["sub_tournament_id" => $sub_tournament->id])->orderBy("point","DESC")->orderBy("time","ASC")->get()->toArray());

            }
        }
        else{

        }

    }


    public function participate($user_id,$sub_tournament_id){
        $sub_tournament = SubTournament::find($sub_tournament_id);
        if(!$sub_tournament){
            throw new \Exception("Суб турнира не существует");
        }
        if(($sub_tournament->start_at < Carbon::now()) && (Carbon::now()< $sub_tournament->end_at)){
            if(SubTournamentParticipant::where(["user_id"=>$user_id,"sub_tournament_id"=>$sub_tournament_id,])->count()){
                throw new \Exception("Вы уже участвовали в турнире");
            }
            SubTournamentParticipant::add(["user_id"=>$user_id,"sub_tournament_id"=>$sub_tournament_id,"status"=>1]);
        }
        else{
            throw new \Exception("Дата турнира прошла");
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
        $subject = Subject::where(["id"=>$tournament->subject_id])->get();
        //Now get questions
        $questions = $question_service->get_questions(
            $subject,
            $questions,
            QuestionService::TOURNAMENT_TYPE,
            $locale_id,
            $sub_tournament->single_question_quantity,
            $sub_tournament->context_question_quantity,
            $sub_tournament->multiple_question_quantity);
        $count_question = $question_service->get_questions_max_point($questions);
        $attempt_service = new AttemptService();
        $attempt = $attempt_service->create_attempt($user_id,QuestionService::TOURNAMENT_TYPE,$locale_id,$count_question,$questions,$sub_tournament->time);
        SubTournamentResult::add([
            'user_id' => $user_id,
            'sub_tournament_id' => $sub_tournament_id,
            'point' => 0,
            'time' => 0,
            'attempt_id' => $attempt->id
        ]);


    }









}
