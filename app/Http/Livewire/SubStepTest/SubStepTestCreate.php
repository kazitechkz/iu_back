<?php

namespace App\Http\Livewire\SubStepTest;

use App\Http\Requests\SubStepTest\SubStepTestCreateRequest;
use App\Models\Locale;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubjectContext;
use App\Models\SubStep;
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
        }
        $this->answer_a = old($this->answer_a) ?? null;
        $this->answer_b = old($this->answer_b) ?? null;
        $this->answer_c = old($this->answer_c) ?? null;
        $this->answer_d = old($this->answer_d) ?? null;
    }

    public function updatedSubjectId(): void
    {
        $this->steps = Step::where('subject_id', $this->subject_id)->get();
        $this->contexts = SubjectContext::where('subject_id', $this->subject_id)->get();
        $this->sub_steps = null;
        $this->step_id = null;
        $this->sub_step_id = null;
        $this->context_id = null;
    }

    public function updatedStepId(): void
    {
        $this->sub_steps = SubStep::where('step_id', $this->step_id)->get();
        $this->sub_step_id = null;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.sub-step-test.sub-step-test-create');
    }
}
