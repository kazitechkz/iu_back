<?php

namespace App\Http\Livewire\SubStepVideo;

use App\Http\Requests\SubStepVideo\SubStepVideoCreate;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubStep;
use Livewire\Component;

class Create extends Component
{
    public $subjects;
    public int|null $subject_id;
    public $steps;
    public int|null $step_id;
    public $sub_step_id;
    public $sub_steps;
    public $url;

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function rules(): array
    {
        return (new SubStepVideoCreate())->rules();
    }
    public function mount($sub_step = null): void
    {
        if ($sub_step) {
            $this->sub_step_id = $sub_step->id;
            $this->steps = Step::where('subject_id', $sub_step->step->subject_id)->get();
            $this->step_id = $sub_step->step->id;
            $this->subject_id = $sub_step->step->subject_id;
            $this->sub_steps = SubStep::where(["step_id" => $sub_step->step->id])->get();
        } else {
            $this->steps = Step::where('is_active', true)->get();
        }
        $this->subjects = Subject::all();
    }

    public function updatedSubjectId(): void
    {
        $this->steps = Step::where('subject_id', $this->subject_id)->orderBy('level', 'asc')->get();
        $this->step_id = null;
        $this->sub_step_id = null;
    }

    public function updatedStepId(): void
    {
        $this->sub_steps = SubStep::where('step_id', $this->step_id)->orderBy('level', 'asc')->get();
        $this->sub_step_id = null;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.sub-step-video.create');
    }
}
