<?php

namespace App\Http\Livewire\AppealType;

use App\Http\Requests\AppealType\AppealTypeCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $isActive;

    public function mount(){
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? "";
        $this->isActive = old("isActive") ?? true;
    }
    protected function rules(){
        return (new AppealTypeCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.appeal-type.create');
    }
}
