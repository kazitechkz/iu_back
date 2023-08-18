<?php

namespace App\Http\Livewire\Faq;

use App\Http\Requests\Faq\FaqCreateRequest;
use App\Http\Requests\Faq\FaqUpdateRequest;
use App\Models\Faq;
use App\Models\Locale;
use Livewire\Component;

class Edit extends Component
{
    public string $question;
    public string $answer;
    public bool $is_active;
    public $locale_id;
    public $locales;
    public Faq $faq;


    public function mount(Faq $faq){
        $this->faq = $faq;
        $this->locales = Locale::where("isActive",true)->get();
        $this->question = $this->faq->question;
        $this->answer = $this->faq->answer;
        $this->is_active = $this->faq->is_active;
        $this->locale_id = $this->faq->locale_id;
    }

    protected function rules(){
        return (new FaqUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.faq.edit');
    }
}
