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
    public Question $question_ru;
    public array $correct_answers;
    public array $correct_answers_ru;

    public function mount($question, $question_ru = null): void
    {
        $this->question = $question;
        $this->correct_answers = explode(',', $question->correct_answers);
        if ($question_ru) {
            $this->question_ru = $question_ru;
            $this->correct_answers_ru = explode(',', $question_ru->correct_answers);
        }
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
