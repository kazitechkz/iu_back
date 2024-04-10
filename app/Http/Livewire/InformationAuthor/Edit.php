<?php

namespace App\Http\Livewire\InformationAuthor;

use App\Http\Requests\InformationAuthor\InformationAuthorEditRequest;
use App\Models\InformationAuthor;
use Livewire\Component;

class Edit extends Component
{
    public $name;
    public $image_url;
    public InformationAuthor $informationAuthor;

    public function mount(InformationAuthor $informationAuthor){
        $this->name = $informationAuthor->name;
        $this->informationAuthor = $informationAuthor;
    }

    protected function rules(){
        return (new InformationAuthorEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.information-author.edit');
    }
}
