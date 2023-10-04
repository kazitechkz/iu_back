<?php

namespace App\Http\Livewire\SubStepVideo;

use App\Http\Requests\SubStepVideo\SubStepVideoCreate;
use App\Models\Step;
use App\Models\Subject;
use App\Models\SubStep;
use Livewire\Component;

class Edit extends Component
{
    public $subjects;
    public int|null $subject_id;
    public $steps;
    public int|null $step_id;
    public $sub_step_id;
    public $sub_steps;
    public $url;
    public $video;

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function rules(): array
    {
        return (new SubStepVideoCreate())->rules();
    }
    public function mount($video): void
    {
        $this->video = $video;
        $this->subjects = Subject::all();
        $this->subject_id = $video->sub_step->step->subject_id;
        $this->steps = Step::where('subject_id', $this->subject_id)->orderBy('level', 'asc')->get();
        $this->step_id = $video->sub_step->step_id;
        $this->sub_steps = SubStep::where('step_id', $this->step_id)->orderBy('level', 'asc')->get();
        $this->sub_step_id = $video->sub_step_id;
        $this->url = $video->url;
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
        return view('livewire.sub-step-video.edit');
    }
}
