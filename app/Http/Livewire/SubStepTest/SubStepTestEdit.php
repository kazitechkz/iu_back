<?php

namespace App\Http\Livewire\SubStepTest;

use App\Http\Requests\SubStepTest\SubStepTestCreateRequest;
use App\Models\Locale;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubjectContext;
use App\Models\SubStep;
use Livewire\Component;

class SubStepTestEdit extends Component
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
    public int $question_id;
    public $listCorrectAnswers = ['a', 'b', 'c', 'd'];

    public function rules(): array
    {
        return (new SubStepTestCreateRequest())->rules();
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function mount($item): void
    {
        $this->question_id = $item->question_id;
        $this->subjects = Subject::all();
        $this->locales = Locale::all();
        $this->text = $item->question->text;
        $this->answer_a = $item->question->answer_a;
        $this->answer_b = $item->question->answer_b;
        $this->answer_c = $item->question->answer_c;
        $this->answer_d = $item->question->answer_d;
        $this->correct_answers = $item->question->correct_answers;
        $this->locale_id = $item->question->locale_id;
        $this->subject_id = $item->sub_step->step->subject_id;
        $this->step_id = $item->sub_step->step_id;
        $this->sub_step_id = $item->sub_step_id;
        $this->context_id = $item->question->context_id;
        $this->context = $item->question->context ? $item->question->context->context : null;
        $this->contexts = SubjectContext::where('subject_id', $this->subject_id)->get();
        $this->steps = Step::where('subject_id', $this->subject_id)->get();
        $this->sub_steps = SubStep::where('step_id', $this->step_id)->get();
    }

    public function updatedSubjectId(): void
    {
        $this->steps = Step::where('subject_id', $this->subject_id)->get();
        $this->contexts = SubjectContext::where('subject_id', $this->subject_id)->get();
        $this->sub_steps = null;
        $this->step_id = null;
        $this->sub_step_id = null;
    }

    public function updatedStepId(): void
    {
        $this->sub_steps = SubStep::where('step_id', $this->step_id)->get();
        $this->sub_step_id = null;
    }
    public function render()
    {
        return view('livewire.sub-step-test.sub-step-test-edit');
    }
}
