<?php

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class ChangeCategory extends Component
{
    public $category_id;
    public $categories;
    public $question;
    public function mount($question): void
    {
        $this->category_id = $question->category_id;
        $this->categories = Category::where('subject_id', $question->subject_id)->get();
        $this->question = Question::findOrFail($question->id);
    }
    public function updatedCategoryId(): void
    {
        $this->question->category_id = $this->category_id;
        $this->question->save();
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.question.change-category');
    }
}
