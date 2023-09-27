<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Category;
use App\Models\Locale;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OnQuestion extends Component
{
    public bool $show = false;
    public $subjects;
    public $questions;
    public $locales;
    public int|null $locale_id = 2;
    public $subject;
    public int|null $subject_id;

    public $categories;
    public int|null $category_id;

    public function mount(): void
    {
        $this->subjects = Subject::all();
        $this->locales = Locale::all();
    }

    public function updatedSubjectId(): void
    {
        if ($this->subject_id) {
            $this->show = true;
            $this->subject = Subject::find($this->subject_id);
            $this->questions = Question::where(['subject_id' => $this->subject_id, 'locale_id' => $this->locale_id])->get();
            $this->categories = Category::with('subcategories')->where('subject_id', $this->subject_id)->get();
        } else {
            $this->show = false;
        }
    }

    public function updatedLocaleId(): void
    {
        $this->questions = Question::where(['subject_id' => $this->subject_id, 'locale_id' => $this->locale_id])->get();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.statistic.on-question');
    }
}
