<?php

namespace App\Http\Livewire\Locale;

use App\Http\Requests\Locale\LocaleCreateRequest;
use App\Http\Requests\Locale\LocaleUpdateRequest;
use App\Models\Locale;
use Livewire\Component;

class Edit extends Component
{
    public string $title = "";
    public string $code = "";
    public bool $isActive = false;
    public int $locale_id;
    public Locale $locale;
    public function mount(){
        $this->locale_id = $this->locale->id;
        $this->title = $this->locale->title;
        $this->code = $this->locale->code;
        $this->isActive = $this->locale->isActive;
    }
    protected function rules(){
        return (new LocaleUpdateRequest())->rules($this->locale->id);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.locale.edit');
    }
}
