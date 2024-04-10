<?php

namespace App\Http\Livewire\InformationCategory;

use App\Http\Requests\InformationCategory\InformationCategoryCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public string $title_ru;
    public string $title_kk;

    public function mount(){
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
    }

    protected function rules(){
        return (new InformationCategoryCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.information-category.create');
    }
}
