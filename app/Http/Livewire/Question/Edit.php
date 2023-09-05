<?php

namespace App\Http\Livewire\Question;

use App\Helpers\StrHelper;
use App\Http\Requests\Question\CreateRequest;
use App\Models\Category;
use App\Models\Group;
use App\Models\Locale;
use App\Models\QuestionType;
use App\Models\Subject;
use App\Models\SubjectContext;
use Livewire\Component;

class Edit extends Component
{
    public bool $showAnswersInput;
    public $question;
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
    public $contexts;
    public $context_id;
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
    public function mount($question): void
    {
        $this->question = $question;
        $this->subjects = Subject::all();
        $this->types = QuestionType::all();
        $this->locales = Locale::all();
        $this->groups = Group::all();
        $this->subject_id = $question->subject_id;
        $this->type_id = $question->type_id;
        $this->group_id = $question->group_id;
        $this->locale_id = $question->locale_id;
        $this->categories = Category::where('subject_id', $question->subject_id)->get();
        $this->category_id = $question->category_id;
        $this->answer_a = StrHelper::convertLatex($question->answer_a);
        $this->answer_b = StrHelper::convertLatex($question->answer_b);
        $this->answer_c = StrHelper::convertLatex($question->answer_c);
        $this->answer_d = StrHelper::convertLatex($question->answer_d);
        $this->answer_e = $question->answer_e != null ?? StrHelper::convertLatex($question->answer_e);
        $this->answer_f = $question->answer_f != null ?? StrHelper::convertLatex($question->answer_f);
        $this->answer_g = $question->answer_g != null ?? StrHelper::convertLatex($question->answer_g);
        $this->answer_h = $question->answer_h != null ?? StrHelper::convertLatex($question->answer_h);
        $this->correct_answers = explode(',', $question->correct_answers);
        $this->text = StrHelper::convertLatex($question->text);
        $this->contexts = SubjectContext::where('subject_id', $question->subject_id)->get();
        $this->prompt = StrHelper::convertLatex($question->prompt);
        $this->explanation = StrHelper::convertLatex($question->explanation);
        $this->context_id = $question->context_id != null ? $question->context_id : null;
    }

    public function selectCategory(): void
    {
        $this->categories = Category::where('subject_id', $this->subject_id)->get();
    }

    public function updatedSubjectId(): void
    {
        $this->categories = Category::where('subject_id', $this->subject_id)->get();
        $this->contexts = SubjectContext::where('subject_id', $this->subject_id)->get();
        $this->category_id = null;
        $this->context_id = null;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.question.edit');
    }
}
