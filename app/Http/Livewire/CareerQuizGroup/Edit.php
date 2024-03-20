<?php

namespace App\Http\Livewire\CareerQuizGroup;

use App\Http\Requests\CareerQuizGroup\CareerQuizGroupCreate;
use App\Http\Requests\CareerQuizGroup\CareerQuizGroupEdit;
use App\Models\CareerQuizGroup;
use Livewire\Component;

class Edit extends Component
{
    public $careerQuizGroup;
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $description_ru;
    public $description_kk;
    public $description_en;
    public $email;
    public $phone;
    public $address;
    public $price;
    public $old_price;
    public $currency;

    public function mount(CareerQuizGroup $careerQuizGroup){
        $this->careerQuizGroup = $careerQuizGroup;
        $this->title_ru = $this->careerQuizGroup->title_ru;
        $this->title_kk = $this->careerQuizGroup->title_kk;
        $this->title_en = $this->careerQuizGroup->title_en;
        $this->description_ru = $this->careerQuizGroup->description_ru;
        $this->description_kk = $this->careerQuizGroup->description_kk;
        $this->description_en = $this->careerQuizGroup->description_en;
        $this->email = $this->careerQuizGroup->email;
        $this->phone = $this->careerQuizGroup->phone;
        $this->address = $this->careerQuizGroup->address;
        $this->price = $this->careerQuizGroup->price;
        $this->old_price = $this->careerQuizGroup->old_price;
        $this->currency = $this->careerQuizGroup->currency;
    }

    protected function rules(){
        return (new CareerQuizGroupEdit())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.career-quiz-group.edit');
    }
}
