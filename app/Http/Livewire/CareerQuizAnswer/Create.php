<?php

namespace App\Http\Livewire\CareerQuizAnswer;

use App\Http\Requests\CareerQuizAnswer\CareerQuizAnswerCreate;
use App\Models\CareerQuiz;
use App\Models\CareerQuizAnswer;
use App\Models\CareerQuizFeature;
use App\Models\CareerQuizQuestion;
use App\Services\CareerQuizService;
use Livewire\Component;

class Create extends Component
{

    public $quizzes;
    public $quiz_id;
    public $questions = [];
    public $question_id;
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $value;
    public $features;
    public $feature_id;

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
    public function updatedQuizId(): void {
        $quiz = CareerQuiz::where(["id"=>$this->quiz_id])->first();
        if($quiz->code == CareerQuizService::CAREER_DRAG_DROP_ANSWER || $quiz->code == CareerQuizService::CAREER_QUESTIONS_AND_ANSWERS){
            $this->features = CareerQuizFeature::where(["quiz_id" => $this->quiz_id])->get();
            $this->questions = CareerQuizQuestion::where(["quiz_id" => $this->quiz_id])->get();
            $this->feature_id = null;
            $this->question_id = null;
        }
        else{
            $this->features = null;
            $this->questions = null;
            $this->feature_id = null;
            $this->question_id = null;
        }
    }

    public function updatedQuestionId(){
        $careerFeatureIds = CareerQuizAnswer::where(["quiz_id" => $this->quiz_id,"question_id"=>$this->question_id])->pluck("feature_id")->toArray();
        $this->features = CareerQuizFeature::whereNotIn("id",$careerFeatureIds)->where(["quiz_id" => $this->quiz_id])->get();

    }

    public function render()
    {
        return view('livewire.career-quiz-answer.create');
    }
}
