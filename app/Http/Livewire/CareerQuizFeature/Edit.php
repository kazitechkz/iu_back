<?php

namespace App\Http\Livewire\CareerQuizFeature;

use App\Http\Requests\CareerQuizFeature\CareerQuizFeatureCreate;
use App\Http\Requests\CareerQuizFeature\CareerQuizFeatureEdit;
use App\Models\CareerQuiz;
use App\Models\CareerQuizFeature;
use Livewire\Component;

class Edit extends Component
{
    public $careerQuizFeature;
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

    public function mount(CareerQuizFeature $careerQuizFeature){
        $this->careerQuizFeature = $careerQuizFeature;
        $this->quizzes = CareerQuiz::with("career_quiz_group")->get();
        $this->quiz_id = $this->careerQuizFeature->quiz_id;
        $this->title_ru = $this->careerQuizFeature->title_ru;
        $this->title_kk = $this->careerQuizFeature->title_kk;
        $this->title_en = $this->careerQuizFeature->title_en;
        $this->description_ru = $this->careerQuizFeature->description_ru;
        $this->description_kk = $this->careerQuizFeature->description_kk;
        $this->description_en = $this->careerQuizFeature->description_en;
        $this->activity_ru = $this->careerQuizFeature->activity_ru;
        $this->activity_kk = $this->careerQuizFeature->activity_kk;
        $this->activity_en = $this->careerQuizFeature->activity_en;
        $this->prospect_ru = $this->careerQuizFeature->prospect_ru;
        $this->prospect_kk = $this->careerQuizFeature->prospect_kk;
        $this->prospect_en = $this->careerQuizFeature->prospect_en;
        $this->meaning_ru = $this->careerQuizFeature->meaning_ru;
        $this->meaning_kk = $this->careerQuizFeature->meaning_kk;
        $this->meaning_en = $this->careerQuizFeature->meaning_en;
        $this->image_url = $this->careerQuizFeature->image_url;
    }

    protected function rules(){
        return (new CareerQuizFeatureEdit())->rules();
    }
    public function render()
    {
        return view('livewire.career-quiz-feature.edit');
    }
}
