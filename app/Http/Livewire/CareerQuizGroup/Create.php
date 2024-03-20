<?php

namespace App\Http\Livewire\CareerQuizGroup;

use App\Http\Requests\CareerQuizGroup\CareerQuizGroupCreate;
use App\Http\Requests\Faq\FaqCreateRequest;
use App\Models\Locale;
use Livewire\Component;

class Create extends Component
{
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

    public function mount(){
        $this->title_ru = old("title_ru");
        $this->title_kk = old("title_kk");
        $this->title_en = old("title_en");
        $this->description_ru = old("description_ru");
        $this->description_kk = old("description_kk");
        $this->description_en = old("description_en");
        $this->email = old("email");
        $this->phone = old("phone");
        $this->address = old("address");
        $this->price = old("price");
        $this->old_price = old("old_price");
        $this->currency = old("currency");
    }

    protected function rules(){
        return (new CareerQuizGroupCreate())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.career-quiz-group.create');
    }
}
