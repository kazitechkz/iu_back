<?php

namespace App\Http\Livewire\TechSupportCategory;

use App\Http\Requests\TechSupportCategory\TechSupportCategoryCreateRequest;
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
        return (new TechSupportCategoryCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.tech-support-category.create');
    }
}
