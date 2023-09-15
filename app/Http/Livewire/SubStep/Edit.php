<?php

namespace App\Http\Livewire\SubStep;

use App\Http\Requests\SubStep\SubStepCreateRequest;
use App\Http\Requests\SubStep\SubStepUpdateRequest;
use App\Models\Step;
use App\Models\SubCategory;
use App\Models\Subject;
use Livewire\Component;

class Edit extends Component
{
    public string|null $title_ru;
    public string|null $title_kk;
    public string|null $title_en;
    public $subjects;
    public int|null $subject_id;
    public $steps;
    public $step;
    public $sub_step;
    public int|null $step_id = null;

    public $sub_categories;
    public $sub_category_id;
    public $level;
    public bool $is_active;


    public function mount($sub_step): void
    {
        $this->subjects = Subject::all();
        $this->subject_id = $sub_step->step->subject_id;
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

    protected function rules(): array
    {
        return (new SubStepUpdateRequest())->rules();
    }

    public function updatedSubjectId(): void
    {
        $this->steps = Step::where('subject_id', $this->subject_id)->get();
        $this->step_id = null;
        $this->sub_category_id = null;
        $this->title_ru = null;
        $this->title_kk = null;
    }
    public function updatedStepId(): void
    {
        $this->step = Step::find($this->step_id);
        $this->sub_categories = SubCategory::where(["category_id" => $this->step->category_id])->get();
        $this->sub_category_id = null;
        $this->title_ru = null;
        $this->title_kk = null;
    }

    public function updatedSubCategoryId(): void
    {
        $cat = SubCategory::firstWhere(['id' => $this->sub_category_id, 'category_id' => $this->step->category_id]);
        $this->title_kk = $cat->title_kk;
        $this->title_ru = $cat->title_ru;
    }


    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if ($this->step_id) {
            $this->step = Step::find($this->step_id);
            $this->sub_categories = SubCategory::where(["category_id" => $this->step->category_id])->get();
        }
        return view('livewire.sub-step.edit');
    }
}
