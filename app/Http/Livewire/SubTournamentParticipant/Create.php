<?php

namespace App\Http\Livewire\SubTournamentParticipant;

use App\Http\Requests\CareerQuizCoupon\CareerQuizCouponCreate;
use App\Http\Requests\SubTournamentParticipant\SubTournamentParticipantCreate;
use App\Models\CareerQuiz;
use App\Models\CareerQuizGroup;
use App\Models\Step;
use App\Models\SubTournament;
use App\Models\SubTournamentParticipant;
use App\Models\Tournament;
use App\Models\TournamentStep;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Create extends Component
{
    public $tournaments;
    public $sub_tournaments;
    public $user_id;
    public $users;
    public $user_search;
    public $sub_tournament_id;
    public $steps;
    public $step_id;
    public $tournament_id;

    public function mount(){
        $this->tournaments = Tournament::all();
        $this->user_id = old("user_id");
        $this->tournament_id = old("tournament_id");
        $this->sub_tournament_id = old("sub_tournament_id");
        if($this->tournament_id){
            $subtournamentsID = SubTournament::where(["tournament_id" => $this->tournament_id])->pluck("step_id")->toArray();
            $this->steps = TournamentStep::whereIn("id",$subtournamentsID)->get();
        }
        $this->findUser();
    }

    public function updatedTournamentId()
    {
        if($this->tournament_id){
            $subtournamentsID = SubTournament::where(["tournament_id" => $this->tournament_id])->pluck("step_id")->toArray();
            $this->steps = TournamentStep::whereIn("id",$subtournamentsID)->get();
        }
        else{
            $this->steps = null;
        }
        $this->step_id = null;
        $this->sub_tournaments = null;
        $this->sub_tournament_id = null;
    }
    public function updatedStepId()
    {
        if($this->tournament_id && $this->tournament_id){
            $this->sub_tournaments = SubTournament::where(["tournament_id" => $this->tournament_id,"step_id" => $this->step_id])->with("tournament_step")->first();
            if($this->sub_tournaments){
                $this->sub_tournament_id = $this->sub_tournaments->id;
            }
            else{
                toastr()->warning("Создайте субтурнир!");
                $this->sub_tournament_id = null;
            }
        }
        else{
            $this->sub_tournaments = null;
            $this->sub_tournament_id = null;
        }
    }

    public function findUser()
    {
        if($this->user_search && $this->sub_tournament_id){
            $participantIDS = SubTournamentParticipant::where(["sub_tournament_id" => $this->sub_tournament_id])->pluck("user_id")->toArray();
            $search = $this->user_search;
            $this->users = User::whereNotIn("id",$participantIDS)->where(function (Builder $query) use ($search) {
                $query->where("name","LIKE","%".$search."%")->orWhere("email","LIKE","%".$search."%");
            })->take(20)->get();
            toastr()->success("Найдено совпадений:" .$this->users->count());
        }
    }

    protected function rules(){
        return (new SubTournamentParticipantCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.sub-tournament-participant.create');
    }
}
