<?php

namespace App\Http\Livewire\CareerQuizAnswer;

use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerCreate;
use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerEdit;
use App\Models\CareerQuiz;
use App\Models\CareerQuizAnswer;
use Livewire\Component;

class Edit extends Component
{
    public $careerQuizAnswer;
    public $quizzes;
    public $quiz_id;
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $value;

    public function mount(CareerQuizAnswer $careerQuizAnswer){
        $this->careerQuizAnswer = $careerQuizAnswer;
        $this->quizzes = CareerQuiz::with("career_quiz_group")->get();
        $this->quiz_id = $this->careerQuizAnswer->quiz_id;
        $this->title_ru = $this->careerQuizAnswer->title_ru;
        $this->title_kk = $this->careerQuizAnswer->title_kk;
        $this->title_en = $this->careerQuizAnswer->title_en;
        $this->value = $this->careerQuizAnswer->value;
    }

    protected function rules(){
        return (new CareerQuizAnswerEdit())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.career-quiz-answer.edit');
    }
}
