<?php

namespace App\Http\Livewire\CareerQuizAnswer;

use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerCreate;
use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerEdit;
use App\Models\CareerQuiz;
use App\Models\CareerQuizAnswer;
use App\Models\CareerQuizFeature;
use App\Models\CareerQuizQuestion;
use App\Services\CareerQuizService;
use Livewire\Component;

class Edit extends Component
{
    public $careerQuizAnswer;
    public $quizzes;
    public $quiz_id;
    public $questions;
    public $question_id;
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $value;
    public $features;
    public $feature_id;

    public function mount(CareerQuizAnswer $careerQuizAnswer){
        $this->careerQuizAnswer = $careerQuizAnswer;
        $this->quizzes = CareerQuiz::with("career_quiz_group")->get();
        $this->quiz_id = $this->careerQuizAnswer->quiz_id;
        $this->title_ru = $this->careerQuizAnswer->title_ru;
        $this->title_kk = $this->careerQuizAnswer->title_kk;
        $this->title_en = $this->careerQuizAnswer->title_en;
        $this->value = $this->careerQuizAnswer->value;
        $this->feature_id = $this->careerQuizAnswer->feature_id;
        $this->question_id = $this->careerQuizAnswer->question_id;
        $this->updatedQuizId();
    }

    protected function rules(){
        return (new CareerQuizAnswerEdit())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function updatedQuizId(): void {
        $quiz = CareerQuiz::where(["id"=>$this->quiz_id])->first();
        if($quiz->code == CareerQuizService::CAREER_DRAG_DROP_ANSWER){
            $this->features = CareerQuizFeature::where(["quiz_id" => $this->quiz_id])->get();
            $this->questions = CareerQuizQuestion::where(["quiz_id" => $this->quiz_id])->get();
        }
        else{
            $this->features = null;
            $this->questions = null;
            $this->question_id = null;
            $this->feature_id = null;
        }
    }

    public function render()
    {
        return view('livewire.career-quiz-answer.edit');
    }
}
