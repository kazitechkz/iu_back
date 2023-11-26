<?php

namespace App\Http\Livewire\TechSupportCategory;

use App\Http\Requests\TechSupportCategory\TechSupportCategoryUpdateRequest;
use App\Models\TechSupportCategory;
use Livewire\Component;

class Edit extends Component
{
    public $title_ru;
    public $title_kk;
    public $title_en;
    public $gender;
    public function mount(TechSupportCategory $techSupportCategory){
        $this->techSupportCategory = $techSupportCategory;
        $this->title_ru = $this->techSupportCategory->title_ru ?? "";
        $this->title_kk = $this->techSupportCategory->title_kk ?? "";
        $this->title_en = $this->techSupportCategory->title_en ?? "";
    }
    protected function rules(){
        return (new TechSupportCategoryUpdateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.tech-support-category.edit');
    }
}
