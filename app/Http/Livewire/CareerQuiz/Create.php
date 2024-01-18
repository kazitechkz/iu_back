<?php

namespace App\Http\Livewire\CareerQuiz;

use App\Http\Requests\CareerQuiz\CareerQuizCreate;
use App\Models\CareerQuizAuthor;
use App\Models\CareerQuizGroup;
use App\Models\Group;
use Livewire\Component;

class Create extends Component
{
    public $groups;
    public $quiz_authors;
    public $group_id;
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
    public $currency;

    public function mount(){
        $this->groups = CareerQuizGroup::all();
        $this->quiz_authors = CareerQuizAuthor::all();
        $this->group_id = old("group_id");
        $this->image_url = old("image_url");
        $this->title_ru = old("title_ru");
        $this->title_kk = old("title_kk");
        $this->title_en = old("title_en");
        $this->description_ru = old("description_ru");
        $this->description_kk = old("description_kk");
        $this->description_en = old("description_en");
        $this->rule_ru = old("rule_ru");
        $this->rule_kk = old("rule_kk");
        $this->rule_en = old("rule_en");
        $this->price = old("price");
        $this->currency = old("currency");
    }



    protected function rules(){
        return (new CareerQuizCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.career-quiz.create');
    }
}
