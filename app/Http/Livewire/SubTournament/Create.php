<?php

namespace App\Http\Livewire\SubTournament;

use App\Http\Requests\SubTournament\SubTournamentCreateRequest;
use App\Models\SubTournament;
use App\Models\Tournament;
use App\Models\TournamentStep;
use Livewire\Component;

class Create extends Component
{

    public Tournament $tournament;
    public $tournaments;
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
        $this->tournaments = Tournament::where(["id"=>$this->tournament->id])->get();
        $this->steps = TournamentStep::all();
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }




    public function render()
    {
        return view('livewire.sub-tournament.create');
    }
}
