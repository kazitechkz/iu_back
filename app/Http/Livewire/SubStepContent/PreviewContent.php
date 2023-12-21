<?php

namespace App\Http\Livewire\SubStepContent;

use App\Models\SubStepContent;
use Livewire\Component;

class PreviewContent extends Component
{
    public bool $showModal = false;
    public $text_kk;
    public $text_ru;
    public SubStepContent $content;

    public function mount($content): void
    {
        $this->content = $content;
    }

    public function open(): void
    {
        $this->showModal = !$this->showModal;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.sub-step-content.preview-content');
    }
}
