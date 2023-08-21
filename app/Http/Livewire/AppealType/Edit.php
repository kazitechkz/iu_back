<?php

namespace App\Http\Livewire\AppealType;

use App\Http\Requests\AppealType\AppealTypeUpdateRequest;
use App\Models\AppealType;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $isActive;
    public AppealType $appealType;

    public function mount(AppealType $appealType){
        $this->appealType = $appealType;
        $this->title_ru = $this->appealType->title_ru ?? "";
        $this->title_kk = $this->appealType->title_kk ?? "";
        $this->title_en = $this->appealType->title_en ?? "";
        $this->isActive = $this->appealType->isActive ?? true;
    }
    protected function rules(){
        return (new AppealTypeUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.appeal-type.edit');
    }
}
