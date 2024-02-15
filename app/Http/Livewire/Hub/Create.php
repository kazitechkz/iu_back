<?php

namespace App\Http\Livewire\Hub;

use Livewire\Component;

class Create extends Component
{
    public $title_ru;
    public $title_kk;
    public function mount(): void
    {
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
    }
    protected $rules = [
        'title_kk' => 'required',
        'title_ru' => 'required'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.hub.create');
    }
}
