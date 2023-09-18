<?php

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class ChangeCategory extends Component
{
    public $category_id;
    public $sub_category_id;
    public $categories;
    public $subcategories;
    public $question;
    public function mount($question): void
    {
        $this->category_id = $question->category_id;
        $this->sub_category_id = $question->sub_category_id;
        $this->categories = Category::where('subject_id', $question->subject_id)->get();
        $this->question = Question::findOrFail($question->id);
    }
    public function updatedSubCategoryId(): void
    {
        if ($this->sub_category_id != 0) {
            $this->question->sub_category_id = $this->sub_category_id;
            $this->question->save();
        }
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.question.change-category');
    }
}
