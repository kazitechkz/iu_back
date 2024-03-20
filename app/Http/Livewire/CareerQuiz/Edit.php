<?php

namespace App\Http\Livewire\CareerQuiz;

use App\Http\Requests\CareerQuiz\CareerQuizEdit;
use App\Http\Requests\CareerQuizGroup\CareerQuizGroupEdit;
use App\Models\CareerQuiz;
use App\Models\CareerQuizAuthor;
use App\Models\CareerQuizCreator;
use App\Models\CareerQuizGroup;
use App\Services\CareerQuizService;
use Livewire\Component;

class Edit extends Component
{
    public CareerQuiz $careerQuiz;
    public $groups;
    public $group_id;
    public $quiz_authors;
    public $authors = [];
    public $image_url;
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $description_ru;
    public $description_kk;
    public $description_en;
    public $rule_ru;
    public $rule_kk;
    public $rule_en;
    public $price;
    public $old_price;
    public $order;
    public $currency;
    public $codes = CareerQuizService::CAREER_QUIZ_CODES;
    public $code;
    public function mount(CareerQuiz $careerQuiz){
        $this->careerQuiz = $careerQuiz;
        $this->groups = CareerQuizGroup::all();
        $this->quiz_authors = CareerQuizAuthor::all();
        $this->authors = CareerQuizCreator::where(["quiz_id" => $careerQuiz->id])->pluck("author_id")->toArray();
        $this->group_id = $this->careerQuiz->group_id;
        $this->image_url = $this->careerQuiz->image_url;
        $this->title_ru = $this->careerQuiz->title_ru;
        $this->title_kk = $this->careerQuiz->title_kk;
        $this->title_en = $this->careerQuiz->title_en;
        $this->description_ru = $this->careerQuiz->description_ru;
        $this->description_kk = $this->careerQuiz->description_kk;
        $this->description_en = $this->careerQuiz->description_en;
        $this->rule_ru = $this->careerQuiz->rule_ru;
        $this->rule_kk = $this->careerQuiz->rule_kk;
        $this->rule_en = $this->careerQuiz->rule_en;
        $this->price = $this->careerQuiz->price;
        $this->old_price = $this->careerQuiz->old_price;
        $this->order = $this->careerQuiz->order;
        $this->currency = $this->careerQuiz->currency;
    }
    protected function rules(){
        return (new CareerQuizEdit())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.career-quiz.edit');
    }
}
