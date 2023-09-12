<?php

namespace App\Http\Livewire\Gender;

use App\Http\Requests\Gender\GenderCreateRequest;
use App\Http\Requests\Gender\GenderUpdateRequest;
use App\Models\Gender;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;

    public $gender;
    public function mount(Gender $gender){
        $this->gender = $gender;
        $this->title_ru = $this->gender->title_ru ?? "";
        $this->title_kk = $this->gender->title_kk ?? "";
        $this->title_en = $this->gender->title_en ?? "";
    }
    protected function rules(){
        return (new GenderUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.gender.edit');
    }
}
