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

    public $level;
    public bool $is_free;
    public bool $is_active;
    public $image_url;

    public function mount(): void
    {
        $this->subjects = Subject::all();

        $this->title_ru = old("title_ru") ?? "";
        $this->title_kk = old("title_kk") ?? "";
        $this->title_en = old("title_en") ?? null;
        $this->subject_id = old("subject_id");
        $this->category_id = old("category_id");
        $this->plan_id = old("plan_id");
        $this->level = old("level") ?? 0;
        $this->is_active = old("is_active") ?? true;
        $this->is_free = old("is_free") ?? false;
        $this->image_url = old("image_url");

    }

    protected function rules(): array
    {
        return (new StepCreateRequest())->rules();
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function updatedSubjectId(): void
    {
        $tag = $this->subject_id . '.1';
        $this->plans = Plan::where("tag", $tag)->get();
        $this->categories = Category::where(["subject_id" => $this->subject_id])->get();
        $this->plan_id = null;
        $this->category_id = null;
        $this->title_ru = null;
        $this->title_kk = null;
    }

    public function updatedCategoryId(): void
    {
        $cat = Category::firstWhere(['subject_id' => $this->subject_id, 'id' => $this->category_id]);
        $this->title_ru = $cat->title_ru;
        $this->title_kk = $cat->title_kk;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.step.create');
    }
}
