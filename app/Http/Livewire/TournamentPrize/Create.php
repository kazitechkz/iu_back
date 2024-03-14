<?php

namespace App\Http\Livewire\TournamentPrize;

use App\Http\Requests\TournamentPrize\TournamentPrizeCreateRequest;
use App\Models\Tournament;
use Livewire\Component;

class Create extends Component
{
    public string $title_ru;
    public string $title_kk;
    public string|null $title_en;
    public $is_virtual;
    public $tournament_id;
    public $tournaments;
    public $order;
    public $start_from;
    public $end_to;
    public $value;


    public function mount(){
        $this->tournaments = Tournament::all();
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
        $this->order = old("order");
        $this->start_from = old("start_from");
        $this->end_to = old("end_to");
        $this->value = old("value");
        $this->tournament_id = old("tournament_id");

    }
    protected function rules(){
        $rules = (new TournamentPrizeCreateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.tournament-prize.create');
    }
}
