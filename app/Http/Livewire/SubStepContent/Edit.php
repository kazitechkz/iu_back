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
    public $sub_step_content;

    public function mount($sub_step_content = null){
        $this->sub_step_content = $sub_step_content;
        $this->sub_step_id = $sub_step_content->sub_step_id;
        $this->sub_steps = SubStep::where(["is_active" => true])->get();
        $this->text_ru = $sub_step_content->text_ru ?? "";
        $this->text_kk = $sub_step_content->text_kk ?? "";
        $this->text_en = $sub_step_content->text_en ?? null;
        $this->is_active = $sub_step_content->is_active ?? false;
    }

    protected function rules(){
        $rules = (new SubStepContentUpdateRequest())->rules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.sub-step-content.edit');
    }
}
