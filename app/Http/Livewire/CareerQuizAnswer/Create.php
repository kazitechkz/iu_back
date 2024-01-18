<?php

namespace App\Http\Livewire\CareerQuizAnswer;

use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerCreate;
use App\Models\CareerQuiz;
use Livewire\Component;

class Create extends Component
{

    public $quizzes;
    public $quiz_id;
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $value;

    public function mount(){
        $this->quizzes = CareerQuiz::with("career_quiz_group")->get();
        $this->quiz_id = old("quiz_id") ?? null;
        $this->title_ru = old("title_ru") ?? null;
        $this->title_kk = old("title_kk") ?? null;
        $this->title_en = old("title_en") ?? null;
        $this->value = old("value") ?? null;
    }

    protected function rules(){
        return (new CareerQuizAnswerCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.career-quiz-answer.create');
    }
}
