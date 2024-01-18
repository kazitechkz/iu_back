<?php

namespace App\Http\Livewire\CareerQuizQuestion;

use App\Http\Requests\CareerQuizQuestion\CareerQuizQuestionCreate;
use App\Models\CareerQuiz;
use App\Models\CareerQuizFeature;
use App\Models\CareerQuizQuestion;
use Livewire\Component;

class Edit extends Component
{
    public $careerQuizQuestion;
    public $quizzes;
    public $quiz_id;
    public $features;
    public $feature_id;
    public $question_ru;
    public $question_kk;
    public $question_en;
    public $context_ru;
    public $context_kk;
    public $context_en;


    public function mount(CareerQuizQuestion $careerQuizQuestion){
        $this->careerQuizQuestion = $careerQuizQuestion;
        $this->quizzes = CareerQuiz::all();
        $this->quiz_id = $this->careerQuizQuestion->quiz_id;
        $this->features = CareerQuizFeature::where(["quiz_id" => $this->quiz_id])->get();
        $this->feature_id = $this->careerQuizQuestion->feature_id;
        $this->question_ru = $this->careerQuizQuestion->question_ru;
        $this->question_kk = $this->careerQuizQuestion->question_kk;
        $this->question_en = $this->careerQuizQuestion->question_en;
        $this->context_ru = $this->careerQuizQuestion->context_ru;
        $this->context_kk = $this->careerQuizQuestion->context_kk;
        $this->context_en = $this->careerQuizQuestion->context_en;
    }

    public function updatedQuizId(): void {
        $this->features = CareerQuizFeature::where(["quiz_id" => $this->quiz_id])->get();
        $this->feature_id = null;
    }

    protected function rules(){
        return (new CareerQuizQuestionCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.career-quiz-question.edit');
    }
}
