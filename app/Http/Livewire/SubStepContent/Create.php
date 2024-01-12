<?php

namespace App\Http\Livewire\SubStepContent;

use App\Http\Requests\SubStep\SubStepCreateRequest;
use App\Http\Requests\SubStepContent\SubStepContentCreateRequest;
use App\Models\Step;
use App\Models\SubStep;
use Livewire\Component;

class Create extends Component
{
    public string|null $text_ru;
    public string|null $text_kk;
    public string|null $text_en;
    public bool|null $is_active;

    public $steps;
    public int|null $step_id;
    public $sub_step_id;
    public $sub_steps;
    public $sub_step;
    public int|null $content_id;

    public function mount($sub_step = null): void
    {
        if ($sub_step) {
            $this->sub_step_id = $sub_step->id;
            $this->sub_steps = SubStep::where(["id" => $sub_step->id])->get();
            $this->sub_step = $sub_step;
            $this->text_ru = $sub_step->sub_step_content ? $sub_step->sub_step_content->text_ru : null;
            $this->text_kk = $sub_step->sub_step_content ? $sub_step->sub_step_content->text_kk : null;
            $this->text_en = $sub_step->sub_step_content ? $sub_step->sub_step_content->text_en : null;
            $this->is_active = $sub_step->sub_step_content ? $sub_step->sub_step_content->is_active : null;
            $this->content_id = $sub_step->sub_step_content ? $sub_step->sub_step_content->id : null;
        } else {
            $this->steps = Step::where('is_active', true)->get();
            $this->text_ru = old("text_ru") ?? "";
            $this->text_kk = old("title_kk") ?? "";
            $this->text_en = old("text_en") ?? null;
            $this->is_active = old("is_active") ?? false;
        }
    }

    protected function rules(): array
    {
        return (new SubStepContentCreateRequest())->rules();
    }

    public function updatedStepId(): void
    {
        $this->sub_steps = SubStep::where(['step_id' => $this->step_id, 'is_active' => true])->get();
        $this->sub_step_id = null;
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.sub-step-content.create');
    }
}
