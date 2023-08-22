<?php

namespace App\Http\Livewire\Question;

use App\Http\Requests\Question\CreateRequest;
use App\Models\Category;
use App\Models\Group;
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
    public $subject_id;
    public $categories;
    public $category_id;
    public $groups;
    public $group_id;
    public string $answer_a;
    public string $answer_b;
    public string $answer_c;
    public string $answer_d;
    public string $answer_e;
    public string $answer_f;
    public string $answer_g;
    public string $answer_h;
    public $correct_answers;
    public $text;
    public $context;
    public $prompt;
    public $explanation;
    public array $listCorrectAnswers = ['a','b','c','d','e','f','g','h'];

    protected function rules(): array
    {
        return (new CreateRequest())->rules();
    }
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function mount(): void
    {
        $this->subjects = Subject::all();
        $this->types = QuestionType::all();
        $this->locales = Locale::all();
        $this->groups = Group::all();
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
