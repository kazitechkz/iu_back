<?php

namespace App\Http\Livewire\TechSupportType;

use App\Http\Requests\TechSupportType\TechSupportTypeCreateRequest;
use Livewire\Component;

class Create extends Component
{

    public $title_ru;
    public $title_kk;
    public $title_en;


    public function mount(){
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
    }
    protected function rules(){
        return (new TechSupportTypeCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.tech-support-type.create');
    }
}
