<?php

namespace App\Http\Livewire\SubTournament;

use App\Http\Requests\SubTournament\SubTournamentCreateRequest;
use App\Http\Requests\SubTournament\SubTournamentUpdateRequest;
use App\Models\SubTournament;
use App\Models\Tournament;
use App\Models\TournamentStep;
use Livewire\Component;

class Edit extends Component
{
    public SubTournament $subTournament;
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

    public function mount(SubTournament $subTournament){
        $this->subTournament = $subTournament;
        $this->tournament_id = $this->subTournament->tournament_id;
        $this->tournaments = Tournament::where(["id"=>$this->tournament_id])->get();
        $this->steps = TournamentStep::where(["id"=>$this->subTournament->step_id])->get();
        $this->time = $this->subTournament->time;
        $this->step_id = $this->subTournament->step_id;
        $this->single_question_quantity = $this->subTournament->single_question_quantity;
        $this->multiple_question_quantity = $this->subTournament->multiple_question_quantity;
        $this->context_question_quantity = $this->subTournament->context_question_quantity;
        $this->start_at = $this->subTournament->start_at->format("DD-MM-YYYY HH:mm");
        $this->end_at = $this->subTournament->end_at->format("DD-MM-YYYY HH:mm");
    }
    protected function rules(){
        return (new SubTournamentUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.sub-tournament.edit');
    }
}
