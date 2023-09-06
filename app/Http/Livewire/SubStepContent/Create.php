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

    public $sub_step_id;
    public $sub_steps;
    public $sub_step;

    public function mount($sub_step = null){
        if($sub_step){
            $this->sub_step_id = $sub_step->id;
            $this->sub_steps = SubStep::where(["id" => $sub_step->id])->get();
            $this->sub_step = $sub_step;
        }
        else{
            $this->sub_steps = SubStep::where(["is_active" => true])->get();
        }
        $this->text_ru = old("text_ru") ?? "";
        $this->text_kk = old("title_kk") ?? "";
        $this->text_en = old("text_en") ?? null;
        $this->is_active = old("is_active") ?? false;
    }

    protected function rules(){
        $rules = (new SubStepContentCreateRequest())->rules();
        return $rules;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.sub-step-content.create');
    }
}
