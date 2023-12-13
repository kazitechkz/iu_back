<?php

namespace App\Http\Livewire\Question;

use App\Http\Requests\Question\CreateRequest;
use App\Models\Category;
use App\Models\Group;
use App\Models\Locale;
use App\Models\QuestionType;
use App\Models\SubCategory;
use App\Models\Subject;
use App\Models\SubjectContext;
use Livewire\Component;

class Create extends Component
{
    public bool $showContext = true;
    public $types;
    public int|null $type_id;
    public $locales;
    public int|null $locale_id;
    public $subjects;
    public int|null $subject_id;
    public $categories;
    public int|null $category_id;
    public $subcategories;
    public int|null $sub_category_id;
    public $groups;
    public int|null $group_id;
    public string|null $answer_a;
    public string|null $answer_b;
    public string|null $answer_c;
    public string|null $answer_d;
    public string|null $answer_e;
    public string|null $answer_f;
    public string|null $answer_g;
    public string|null $answer_h;
    public $correct_answers;
    public $text;
    public string|null $context;
    public $contexts;
    public int|null $context_id;
    public $prompt;
    public $explanation;
    public array $listCorrectAnswers = ['a','b','c','d','e','f'];

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
        $this->answer_a = old('answer_a') ?? null;
        $this->answer_b = old('answer_b') ?? null;
        $this->answer_c = old('answer_c') ?? null;
        $this->answer_d = old('answer_d') ?? null;
        $this->answer_e = old('answer_e') ?? null;
        $this->answer_f = old('answer_f') ?? null;
        $this->text = old('text') ?? null;
        $this->locale_id = old('locale_id') ?? null;
        $this->type_id = old('type_id') ?? null;
        $this->category_id = old('category_id') ?? null;
        $this->subject_id = old('subject_id') ?? null;
        $this->group_id = old('group_id') ?? null;
    }
    public function updatedSubjectId(): void
    {
        $this->categories = Category::where('subject_id', $this->subject_id)->get();
        $this->contexts = SubjectContext::where('subject_id', $this->subject_id)->get();
        $this->category_id = null;
        $this->sub_category_id = null;
        $this->context_id = null;
    }
    public function updatedCategoryId(): void
    {
        $this->subcategories = SubCategory::where('category_id', $this->category_id)->get();
        $this->sub_category_id = null;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.question.create');
    }
}
