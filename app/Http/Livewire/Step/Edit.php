<?php

namespace App\Http\Livewire\Step;

use App\Http\Requests\Step\StepCreateRequest;
use App\Http\Requests\Step\StepUpdateRequest;
use App\Models\Category;
use App\Models\Step;
use App\Models\Subject;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Edit extends Component
{
    public string|null $title_ru;
    public string|null $title_kk;
    public string|null $title_en;
    public $step;
    public $subjects;
    public int|null $subject_id;

    public $categories;
    public int|null $category_id;

    public $plans;
    public int|null $plan_id;

    public int $level;
    public int $level_id;
    public bool $is_free;
    public bool $is_active;
    public $image_url;

    public function mount(Step $step){
        $this->subjects = Subject::all();
        $this->step = $step;
        $this->title_ru = $this->step->title_ru;
        $this->title_kk = $this->step->title_kk;
        $this->title_en = $this->step->title_en;
        $this->subject_id = $this->step->subject_id;
        $this->category_id = $this->step->category_id;
        $this->plan_id = $this->step->plan_id;
        $this->level = $this->step->level;
        $this->level_id = $this->step->level;
        $this->is_active = $this->step->is_active;
        $this->is_free = $this->step->is_free;
        $this->image_url = $this->step->image_url;
    }
    protected function rules(){
        $rules = (new StepUpdateRequest())->rules();
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if($this->subject_id){
            $this->plans = Plan::where("tag","{$this->subject_id}")->get();
            $this->categories = Category::where(["subject_id" => $this->subject_id])->get();
        }
        return view('livewire.step.edit');
    }
}
