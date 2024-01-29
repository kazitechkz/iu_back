<?php

namespace App\Http\Livewire\SubTournament;

use App\Http\Requests\SubTournament\SubTournamentCreateRequest;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\SubTournamentResult;
use App\Models\SubTournamentWinner;
use App\Models\Tournament;
use App\Models\TournamentStep;
use App\Models\TournamentWinner;
use Livewire\Component;

class Create extends Component
{

    public Tournament $tournament;
    public $tournaments;
    public $tournament_winner;
    public $steps;
    public int|null $step_id;
    public int|null $tournament_id;
    public int|null $question_quantity;
    public int|null $single_question_quantity;
    public int|null $multiple_question_quantity;
    public int|null $context_question_quantity;
    public int|null $time;
    public $start_at;
    public $end_at;

    public function mount(Tournament $tournament){
        $this->tournament = $tournament;
        $this->tournament_id = $tournament->id;
        $this->tournaments = Tournament::where(["id"=>$this->tournament->id])->with(["sub_tournaments"])->get();
        $this->tournament_winner =  TournamentWinner::where(["tournament_id"=>$this->tournament->id])->first();
        $this->steps = TournamentStep::whereNotIn("id",$this->tournament->sub_tournaments->pluck("step_id","step_id")->toArray())->get();
        $this->time = old("time") ?? null;
        $this->step_id = old("step_id") ?? null;
        $this->single_question_quantity = old("single_question_quantity") ?? null;
        $this->multiple_question_quantity = old("multiple_question_quantity") ?? null;
        $this->context_question_quantity = old("context_question_quantity") ?? null;
        $this->start_at = old("start_at") ?? null;
        $this->end_at = old("end_at") ?? null;
    }
    protected function rules(){
        return (new SubTournamentCreateRequest())->rules();
    }


    public function finishTournament(){
        $sub_tournament = SubTournament::where(["tournament_id"=>$this->tournament->id,"step_id"=>4])->first();

        if($sub_tournament && !$this->tournament_winner){
            $winners = SubTournamentResult::where(["sub_tournament_id" => $sub_tournament->id])->orderBy("point","DESC")->orderBy("time","ASC")->take(1)->pluck("user_id")->toArray();
            foreach ($winners as $winner){
                //Определяем победителей этапа
                if(!SubTournamentWinner::where(["sub_tournament_id"=>$sub_tournament->id])->first()){
                    SubTournamentWinner::add(["user_id"=>$winner,"sub_tournament_id"=>$sub_tournament->id]);
                }
                $sub_tournament->edit([["is_finished"=>true,"is_current"=>true]]);
                $this->tournament_winner = TournamentWinner::add(["winner_id"=>$winner,"tournament_id"=>$this->tournament->id]);
            }
        }
        else{
            toastr()->error("Суб турнир не найден!");
        }


    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.sub-tournament.create');
    }
}
