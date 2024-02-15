<?php

namespace App\Http\Livewire\Hub;

use App\Models\Hub;
use Livewire\Component;

class Edit extends Component
{
    public Hub $hub;
    public $title_ru;
    public $title_kk;
    public function mount(Hub $hub): void
    {
        $this->hub = $hub;
        $this->title_ru = $hub->title_ru;
        $this->title_kk = $hub->title_kk;
    }
    protected $rules = [
        'title_kk' => 'required',
        'title_ru' => 'required'
    ];
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.hub.edit');
    }
}
