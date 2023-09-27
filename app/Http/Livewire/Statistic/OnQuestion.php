<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Category;
use App\Models\Subject;
use Livewire\Component;

class OnQuestion extends Component
{
    public bool $show = false;
    public $subjects;
    public int|null $subject_id;

    public $categories;
    public int|null $category_id;

    public function mount(): void
    {
        $this->subjects = Subject::all();
    }

    public function updatedSubjectId(): void
    {
        if ($this->subject_id) {
            $this->show = true;
            $this->categories = Category::with('subcategories')->where('subject_id', $this->subject_id)->get();
        } else {
            $this->show = false;
        }
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.statistic.on-question');
    }
}
