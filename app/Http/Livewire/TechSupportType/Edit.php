<?php

namespace App\Http\Livewire\TechSupportType;

use App\Http\Requests\TechSupportType\TechSupportTypeUpdateRequest;
use App\Models\TechSupportType;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $gender;
    public function mount(TechSupportType $techSupportType){
        $this->techSupportType = $techSupportType;
        $this->title_ru = $this->techSupportType->title_ru ?? "";
        $this->title_kk = $this->techSupportType->title_kk ?? "";
        $this->title_en = $this->techSupportType->title_en ?? "";
    }
    protected function rules(){
        return (new TechSupportTypeUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.tech-support-type.edit');
    }
}
