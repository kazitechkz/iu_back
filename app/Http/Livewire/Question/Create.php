<?php

namespace App\Http\Livewire\Question;

use App\Models\Locale;
use App\Models\QuestionType;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public bool $showAnswersInput = true;
    public $types;
    public $type_id;
    public $locales;
    public $locale_id;
    public $subjects;
    public $subject_id;
    public $answer_a;
    public $answer_b;
    public $answer_c;
    public $answer_d;
    public $answer_e;
    public $answer_f;
    public $answer_g;
    public $answer_h;

    public function mount(): void
    {
        $this->subjects = Subject::all();
        $this->types = QuestionType::all();
        $this->locales = Locale::all();
    }

    public function toggleQuestionType(): void
    {
        if ($this->type_id == 1) {
            $this->showAnswersInput = false;
        } else {
            $this->showAnswersInput = true;
        }
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.question.create');
    }
}
