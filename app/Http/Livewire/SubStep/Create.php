<?php

namespace App\Http\Livewire\SubStep;

use App\Http\Requests\SubStep\SubStepCreateRequest;
use App\Models\Step;
use App\Models\SubCategory;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public string|null $title_ru;
    public string|null $title_kk;
    public string|null $title_en;

    public $steps;
    public $step;
    public int|null $step_id = null;

    public $sub_categories;
    public $sub_category_id;
    public int $level;
    public bool $is_active;


    public function mount($step_id = null): void
    {
        if ($step_id) {
            $this->step_id = $step_id;
            $this->steps = Step::where(["id" => $step_id])->with("subject")->get();
            $this->step = Step::find($step_id);
        } else {
            $this->steps = Step::where(["is_active" => true])->with("subject")->get();
        }
        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? null;
        $this->level = old("level") ?? 0;
        $this->is_active = old("is_active") ?? true;
        $this->sub_category_id = old("sub_category_id");
    }

    protected function rules(): array
    {
        return (new SubStepCreateRequest())->rules();
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
        return view('livewire.sub-step.create');
    }
}
