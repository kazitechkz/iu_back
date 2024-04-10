<?php

namespace App\Http\Livewire\InformationCategory;

use App\Http\Requests\InformationCategory\InformationCategoryCreateRequest;
use App\Http\Requests\InformationCategory\InformationCategoryEditRequest;
use App\Models\InformationCategory;
use Livewire\Component;

class Edit extends Component
{
    public string $title_ru;
    public string $title_kk;
    public InformationCategory $informationCategory;

    public function mount(InformationCategory $informationCategory){
        $this->informationCategory = $informationCategory;
        $this->title_ru = $this->informationCategory->title_ru;
        $this->title_kk = $this->informationCategory->title_kk;
    }

    protected function rules(){
        return (new InformationCategoryEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.information-category.edit');
    }
}
