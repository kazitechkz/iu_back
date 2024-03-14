<?php

namespace App\Http\Livewire\TournamentPrize;

use App\Http\Requests\TournamentPrize\TournamentPrizeCreateRequest;
use App\Http\Requests\TournamentPrize\TournamentPrizeEditRequest;
use App\Models\Tournament;
use App\Models\TournamentPrize;
use Livewire\Component;

class Edit extends Component
{
    public string $title_ru;
    public string $title_kk;
    public string|null $title_en;
    public $is_virtual;
    public $tournament_id;
    public $tournaments;
    public $tournamentPrize;
    public $order;
    public $start_from;
    public $end_to;
    public $value;


    public function mount(TournamentPrize $tournamentPrize){
        $this->tournaments = Tournament::all();
        $this->tournamentPrize = $tournamentPrize;
        $this->title_ru = $tournamentPrize->title_ru;
        $this->title_kk = $tournamentPrize->title_kk;
        $this->title_en = $tournamentPrize->title_en;
        $this->order = $tournamentPrize->order;
        $this->start_from = $tournamentPrize->start_from;
        $this->end_to = $tournamentPrize->end_to;
        $this->value = $tournamentPrize->value;
        $this->tournament_id = $tournamentPrize->tournament_id;

    }
    protected function rules(){
        $rules = (new TournamentPrizeEditRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.tournament-prize.edit');
    }
}
