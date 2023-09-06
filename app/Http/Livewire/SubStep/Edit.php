<?php

namespace App\Http\Livewire\SubStep;

use App\Http\Requests\SubStep\SubStepCreateRequest;
use App\Http\Requests\SubStep\SubStepUpdateRequest;
use App\Models\Step;
use App\Models\SubCategory;
use Livewire\Component;

class Edit extends Component
{
    public string|null $title_ru;
    public string|null $title_kk;
    public string|null $title_en;

    public $steps;
    public $step;
    public $sub_step;
    public int|null $step_id = null;

    public $sub_categories;
    public $sub_category_id;
    public int $level;
    public bool $is_active;



    public function mount($sub_step){

        $this->sub_step = $sub_step;
        $this->steps = Step::where(["id" => $sub_step->step_id])->with("subject")->get();
        $this->step_id = $sub_step->step_id;
        $this->sub_category_id = $sub_step->sub_category_id;
        $this->title_ru = $this->sub_step->title_ru;
        $this->title_kk = $this->sub_step->title_kk;
        $this->title_en = $this->sub_step->title_en;
        $this->level = $this->sub_step->level;
        $this->is_active = $this->sub_step->is_active ?? true;
    }

    protected function rules(){
        $rules = (new SubStepUpdateRequest())->rules();
        return $rules;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if($this->step_id){
            $this->step = Step::find($this->step_id);
            $this->sub_categories = SubCategory::where(["category_id"=>$this->step->category_id])->get();
        }
        return view('livewire.sub-step.edit');
    }
}
