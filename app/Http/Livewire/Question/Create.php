<?php

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Locale;
use App\Models\QuestionType;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public bool $showAnswersInput;
    public $types;
    public $type_id;
    public $locales;
    public $locale_id;
    public $subjects;
    public $categories;
    public $category_id;
    public $subject_id;
    public string $answer_a;
    public string $answer_b;
    public string $answer_c;
    public string $answer_d;
    public string $answer_e;
    public string $answer_f;
    public string $answer_g;
    public string $answer_h;
    public $correct_answer;
    public $correct_answers;
    public array $listCorrectAnswers = ['a','b','c','d','e','f','g','h'];

    public function mount(): void
    {
        $this->subjects = Subject::all();
        $this->types = QuestionType::all();
        $this->locales = Locale::all();
    }

    public function selectCategory(): void
    {
        $this->categories = Category::where('subject_id', $this->subject_id)->get();
    }

    public function updatedSubjectId()
    {
        $this->categories = Category::where('subject_id', $this->subject_id)->get();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.question.create');
    }
}
