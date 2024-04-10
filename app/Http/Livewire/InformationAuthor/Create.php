<?php

namespace App\Http\Livewire\InformationAuthor;

use App\Http\Requests\InformationAuthor\InformationAuthorCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $image_url;


    public function mount(){
        $this->name = old("name");
    }

    protected function rules(){
        return (new InformationAuthorCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.information-author.create');
    }
}
