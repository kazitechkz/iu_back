<?php

namespace App\Http\Livewire\SubStepContent;

use App\Http\Requests\SubStepContent\SubStepContentCreateRequest;
use App\Http\Requests\SubStepContent\SubStepContentUpdateRequest;
use App\Models\Step;
use App\Models\SubStep;
use Livewire\Component;

class Edit extends Component
{
    public string|null $text_ru;
    public string|null $text_kk;
    public string|null $text_en;
    public bool|null $is_active;

    public $sub_step_id;
    public $sub_steps;
    public $sub_step;
    public $steps;
    public int|null $step_id;
    public $sub_step_content;

    public function mount($sub_step_content = null): void
    {
        $this->step_id = $sub_step_content->sub_step->step_id;
        $this->sub_step_content = $sub_step_content;
        $this->sub_step_id = $sub_step_content->sub_step_id;
        $this->steps = Step::where('is_active', true)->get();
        $this->sub_steps = SubStep::where(['step_id' => $this->step_id, 'is_active' => true])->get();
        $this->text_ru = $sub_step_content->text_ru ?? "";
        $this->text_kk = $sub_step_content->text_kk ?? "";
        $this->text_en = $sub_step_content->text_en ?? null;
        $this->is_active = $sub_step_content->is_active ?? false;
    }
    public function updatedStepId(): void
    {
        $this->sub_steps = SubStep::where(['step_id' => $this->step_id, 'is_active' => true])->get();
        $this->sub_step_id = null;
    }
    protected function rules(): array
    {
        return (new SubStepContentUpdateRequest())->rules();
    }
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.sub-step-content.edit');
    }
}
