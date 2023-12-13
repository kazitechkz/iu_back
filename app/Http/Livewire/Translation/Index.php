<?php

namespace App\Http\Livewire\Translation;
use Livewire\Component;

class Index extends Component
{
    public $question;
    public $questions_ru;

    public function mount($question): void
    {
        $this->question = $question;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.translation.index');
    }
}
