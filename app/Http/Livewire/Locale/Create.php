<?php

namespace App\Http\Livewire\Locale;

use App\Http\Requests\Locale\LocaleCreateRequest;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public string $title = "";
    public string $code = "";
    public bool $isActive = false;
    public function mount(){
       $this->title = old("title")??"";
       $this->code = old("code")??"";
       $this->isActive = old("isActive")??false;
    }
    protected function rules(){
        return (new LocaleCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.locale.create');
    }
}
