<?php

namespace App\Http\Livewire\Tournament;

use App\Http\Requests\Tournament\TournamentCreateRequest;
use App\Http\Requests\Tournament\TournamentUpdateRequest;
use App\Models\Subject;
use App\Models\Tournament;
use Livewire\Component;

class Edit extends Component
{
    public string $title_ru;
    public string $title_kk;
    public string|null $title_en;
    public string $rule_ru;
    public string $rule_kk;
    public string|null $rule_en;
    public string $description_ru;
    public string $description_kk;
    public string|null $description_en;
    public int $price;
    public string $currency;
    public int|null $status;
    public $start_at;
    public $end_at;

    public $subjects;
    public $locales;
    public int|null $subject_id;
    public Tournament $tournament;


    public function mount(Tournament $tournament){
        $this->tournament = $tournament;
        $this->subjects = Subject::all();
        $this->subject_id = $this->tournament->subject_id;
        $this->title_ru = $this->tournament->title_ru;
        $this->title_kk = $this->tournament->title_kk;
        $this->title_en = $this->tournament->title_en;
        $this->rule_ru = $this->tournament->rule_ru;
        $this->rule_kk =  $this->tournament->rule_kk;
        $this->rule_en = $this->tournament->rule_en;
        $this->description_ru = $this->tournament->description_ru;
        $this->description_kk = $this->tournament->description_kk;
        $this->description_en = $this->tournament->description_en;
        $this->price = $this->tournament->price;
        $this->currency =  $this->tournament->currency;
        $this->status = $this->tournament->status;
        $this->start_at = $this->tournament->start_at;
        $this->end_at = $this->tournament->end_at;
    }
    protected function rules(){
        $rules = (new TournamentUpdateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.tournament.edit');
    }
}
