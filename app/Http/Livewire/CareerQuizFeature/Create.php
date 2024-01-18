<?php

namespace App\Http\Livewire\CareerQuizFeature;

use App\Http\Requests\CareerQuizFeature\CareerQuizFeatureCreate;
use App\Models\CareerQuiz;
use Livewire\Component;

class Create extends Component
{
    public $image_url;
    public $quizzes;
    public $quiz_id;
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $description_ru;
    public $description_kk;
    public $description_en;
    public $activity_ru;
    public $activity_kk;
    public $activity_en;
    public $prospect_ru;
    public $prospect_kk;
    public $prospect_en;
    public $meaning_ru;
    public $meaning_kk;
    public $meaning_en;

    public function mount(){
        $this->quizzes = CareerQuiz::with("career_quiz_group")->get();
        $this->quiz_id = old("quiz_id") ?? null;
        $this->title_ru = old("title_ru") ?? null;
        $this->title_kk = old("title_kk") ?? null;
        $this->title_en = old("title_en") ?? null;
        $this->description_ru = old("description_ru") ?? null;
        $this->description_kk = old("description_kk") ?? null;
        $this->description_en = old("description_en") ?? null;
        $this->activity_ru = old("activity_ru") ?? null;
        $this->activity_kk = old("activity_kk") ?? null;
        $this->activity_en = old("activity_en") ?? null;
        $this->prospect_ru = old("prospect_ru") ?? null;
        $this->prospect_kk = old("prospect_kk") ?? null;
        $this->prospect_en = old("prospect_en") ?? null;
        $this->meaning_ru = old("meaning_ru") ?? null;
        $this->meaning_kk = old("meaning_kk") ?? null;
        $this->meaning_en = old("meaning_en") ?? null;
        $this->image_url = old("image_url") ?? null;
    }

    protected function rules(){
        return (new CareerQuizFeatureCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.career-quiz-feature.create');
    }
}
