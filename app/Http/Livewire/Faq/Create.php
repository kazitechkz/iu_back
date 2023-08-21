<?php

namespace App\Http\Livewire\Faq;

use App\Http\Requests\Faq\FaqCreateRequest;
use App\Http\Requests\Locale\LocaleCreateRequest;
use App\Models\Locale;
use Livewire\Component;

class Create extends Component
{
    public string $question;
    public string $answer;
    public bool $is_active;
    public $locale_id;
    public $locales;
    public function mount(){
        $this->locales = Locale::where("isActive",true)->get();
        $this->question = old("question")??"";
        $this->answer = old("answer")??"";
        $this->is_active = old("is_active")??false;
        $this->locale_id = old("locale_id")??null;
    }

    protected function rules(){
        return (new FaqCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.faq.create');
    }
}
