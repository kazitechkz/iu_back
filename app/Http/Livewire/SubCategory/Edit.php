<?php

namespace App\Http\Livewire\SubCategory;

use App\Http\Requests\Subcategory\SubcategoryCreate;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Subject;
use Livewire\Component;

class Edit extends Component
{
    protected $model = SubCategory::class;
    public $subjects;
    public int|null $subject_id;
    public $categories;
    public int|null $category_id;
    public int $image_url;
    public $title_kk;
    public $title_ru;

    protected function rules(): array
    {
        return (new SubcategoryCreate())->rules();
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function mount($subCategory): void
    {
        $this->subjects = Subject::all();
        $this->subject_id = $subCategory->category->subject->id;
        $this->categories = Category::where('subject_id', $subCategory->category->subject->id)->get();
        $this->category_id = $subCategory->category_id;
        $this->title_kk = $subCategory->title_kk;
        $this->title_ru = $subCategory->title_ru;
    }

    public function updatedSubjectId(): void
    {
        $this->category_id = null;
        if ($this->subject_id != null) {
            $this->categories = Category::where('subject_id', $this->subject_id)->get();
        }
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.subcategory.edit');
    }
}
