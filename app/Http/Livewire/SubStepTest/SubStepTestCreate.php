<?php

namespace App\Http\Livewire\SubStepTest;

use App\Http\Requests\SubStepTest\SubStepTestCreateRequest;
use App\Models\Locale;
use App\Models\Question;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubjectContext;
use App\Models\SubStep;
use App\Models\SubStepTest;
use Livewire\Component;

class SubStepTestCreate extends Component
{
    public $subjects;
    public int|null $subject_id;
    public $locales;
    public int|null $locale_id;
    public $steps;
    public int|null $step_id;
    public $sub_steps;
    public int|null $sub_step_id;
    public $text;
    public $answer_a;
    public $answer_b;
    public $answer_c;
    public $answer_d;
    public $correct_answers;
    public string|null $context;
    public $contexts;
    public int|null $context_id;
    public $listCorrectAnswers = ['a', 'b', 'c', 'd'];

    public $sub_step;
    public $questions = [];
    public $stepQuestions = [];

    public function rules(): array
    {
        return (new SubStepTestCreateRequest())->rules();
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function mount($item = null): void
    {
        $this->subjects = Subject::all();
        $this->locales = Locale::all();
        if ($item != null) {
            $this->subject_id = $item->step->subject_id;
            $this->steps = Step::where('subject_id', $this->subject_id)->get();
            $this->step_id = $item->step_id;
            $this->sub_steps = SubStep::where('step_id', $this->step_id)->get();
            $this->sub_step_id = $item->id;
            $this->sub_step = SubStep::with('sub_category')->findOrFail($this->sub_step_id);
        }
//        $this->answer_a = old($this->answer_a) ?? null;
//        $this->answer_b = old($this->answer_b) ?? null;
//        $this->answer_c = old($this->answer_c) ?? null;
//        $this->answer_d = old($this->answer_d) ?? null;
    }

    public function updatedSubjectId(): void
    {
        $this->steps = Step::where('subject_id', $this->subject_id)->orderBy('level', 'asc')->get();
//        $this->contexts = SubjectContext::where('subject_id', $this->subject_id)->get();
        $this->sub_steps = null;
        $this->step_id = null;
        $this->sub_step_id = null;
        $this->sub_step = null;
        $this->stepQuestions = [];
        $this->questions = [];
        $this->locale_id = null;
//        $this->context_id = null;
    }

    public function updatedStepId(): void
    {
        $this->sub_steps = SubStep::where('step_id', $this->step_id)->orderBy('level', 'asc')->get();
        $this->sub_step = null;
        $this->sub_step_id = null;
        $this->stepQuestions = [];
        $this->questions = [];
        $this->locale_id = null;
    }

    public function updatedSubStepId(): void
    {
        $this->sub_step = SubStep::with('sub_category')->findOrFail($this->sub_step_id);
        $this->stepQuestions = [];
        $this->questions = [];
        $this->locale_id = null;
    }

    public function updatedLocaleId(): void
    {
        if ($this->sub_step != null) {
            $this->stepQuestions = SubStepTest::with('question')->where(['locale_id' => $this->locale_id, 'sub_step_id' => $this->sub_step_id])->get();
            $this->questions = Question::where([
                'locale_id' => $this->locale_id,
                'sub_category_id' => $this->sub_step->sub_category_id,
                ['type_id','!=', 3]
            ])->get();
        }
    }

    public function addQuestion(int $question_id): void
    {
        SubStepTest::where(['question_id' => $question_id, 'sub_step_id' => $this->sub_step_id])->firstOrCreate([
           'sub_step_id' => $this->sub_step_id,
           'question_id' => $question_id,
            'locale_id' => $this->locale_id
        ]);
        $this->stepQuestions = SubStepTest::with('question')->where(['locale_id' => $this->locale_id, 'sub_step_id' => $this->sub_step_id])->get();
    }

    public function removeQuestion($question_id): void
    {
        $question = SubStepTest::where(['sub_step_id' => $this->sub_step_id, 'locale_id' => $this->locale_id, 'question_id' => $question_id])->first();
        $question?->delete();
        $this->stepQuestions = SubStepTest::with('question')->where(['locale_id' => $this->locale_id, 'sub_step_id' => $this->sub_step_id])->get();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.sub-step-test.sub-step-test-create');
    }
}
