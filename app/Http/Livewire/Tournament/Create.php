<?php

namespace App\Http\Livewire\Tournament;

use App\Http\Requests\News\NewsCreateRequest;
use App\Http\Requests\Tournament\TournamentCreateRequest;
use App\Models\Locale;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
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


    public function mount(){
        $this->subjects = Subject::all();
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
        $this->rule_ru = old("rule_ru") ?? "";
        $this->rule_kk = old("rule_kk") ?? "";
        $this->rule_en = old("rule_en") ?? "";
        $this->description_ru = old("description_ru") ?? "";
        $this->description_kk = old("description_kk") ?? "";
        $this->description_en = old("description_en") ?? "";
        $this->price = old("price") ?? 0;
        $this->currency = old("currency") ?? "";
        $this->status = old("status") ?? null;
        $this->start_at = old("start_at") ?? null;
        $this->end_at = old("end_at") ?? null;
    }
    protected function rules(){
        $rules = (new TournamentCreateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.tournament.create');
    }
}
