<?php

namespace App\Http\Livewire\Step;

use App\Http\Requests\Step\StepCreateRequest;
use App\Models\Category;
use App\Models\Subject;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Create extends Component
{
    public string|null $title_ru;
    public string|null $title_kk;
    public string|null $title_en;

    public $subjects;
    public int|null $subject_id = null;

    public $categories;
    public int|null $category_id;

    public $plans;
    public int|null $plan_id;

    public int $level;
    public bool $is_free;
    public bool $is_active;
    public $image_url;

    public function mount(){
        $this->subjects = Subject::all();

        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? null;
        $this->subject_id = old("subject_id");
        $this->category_id = old("category_id");
        $this->plan_id = old("plan_id");
        $this->level = old("level")??0;
        $this->is_active = old("is_active") ?? true;
        $this->is_free = old("is_free") ?? false;
        $this->image_url = old("image_url");

    }

    protected function rules(){
        $rules = (new StepCreateRequest())->rules();
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

        return view('livewire.step.create');
    }
}
