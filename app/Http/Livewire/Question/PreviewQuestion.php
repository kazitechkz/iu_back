<?php

namespace App\Http\Livewire\Question;

use App\Helpers\StrHelper;
use App\Models\Question;
use Ismaelw\LaraTeX\LaraTeX;
use Livewire\Component;

class PreviewQuestion extends Component
{
    public bool $showModal = false;
    public Question $question;
    public array $correct_answers;

    public function mount($question): void
    {
        $this->question = $question;
        $this->correct_answers = explode(',', $question->correct_answers);
    }

    public function test()
    {

    }

    public function open(): void
    {
        $this->showModal = !$this->showModal;
    }
    public function render()
    {
        return view('livewire.question.preview-question');
    }
}
