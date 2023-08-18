<?php

namespace App\Http\Livewire\Question;

use App\Models\Locale;
use App\Models\QuestionType;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public $types;
    public $type_id;
    public $locales;
    public $locale_id;
    public $subjects;
    public $subject_id;

    public function mount()
    {
        $this->subjects = Subject::all();
        $this->types = QuestionType::all();
        $this->locales = Locale::all();
    }
    public function render()
    {
        return view('livewire.question.create');
    }
}
