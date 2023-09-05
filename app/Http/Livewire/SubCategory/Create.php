<?php

namespace App\Http\Livewire\SubCategory;

use App\Http\Requests\Subcategory\SubcategoryCreate;
use App\Models\Category;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public $subjects;
    public int $subject_id;
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
    public function mount(): void
    {
        $this->subjects = Subject::all();
    }

    public function updatedSubjectId(): void
    {
        $this->category_id = null;
        $this->categories = Category::where('subject_id', $this->subject_id)->get();
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.subcategory.create');
    }
}
