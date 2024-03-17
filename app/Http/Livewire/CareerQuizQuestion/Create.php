<?php

namespace App\Http\Livewire\CareerQuizQuestion;

use App\Http\Requests\CareerQuizQuestion\CareerQuizQuestionCreate;
use App\Models\CareerQuiz;
use App\Models\CareerQuizFeature;
use App\Services\CareerQuizService;
use Livewire\Component;

class Create extends Component
{
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




    public function mount(){
      $this->quizzes = CareerQuiz::all();
      $this->quiz_id = old("quiz_id");
      $this->feature_id = old("feature_id");
      $this->question_ru = old("question_ru");
      $this->question_kk = old("question_kk");
      $this->question_en = old("question_en");
      $this->context_ru = old("context_ru");
      $this->context_kk = old("context_kk");
      $this->context_en = old("context_en");
    }

    public function updatedQuizId(): void {
        $quiz = CareerQuiz::where(["id"=>$this->quiz_id])->first();
        if($quiz->code == CareerQuizService::CAREER_DRAG_DROP_ANSWER || $quiz->code == CareerQuizService::CAREER_QUESTIONS_AND_ANSWERS){
            $this->features = null;
            $this->feature_id = null;
        }
        else{
            $this->features = CareerQuizFeature::where(["quiz_id" => $this->quiz_id])->get();
            $this->feature_id = null;
        }
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
        return view('livewire.career-quiz-question.create');
    }
}
