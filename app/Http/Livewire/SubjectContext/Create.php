<?php

namespace App\Http\Livewire\SubjectContext;

use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public $subjects;
    public int|null $subject_id;
    public $context;

    public function mount(): void
    {
        $this->subjects = Subject::all();
        $this->subject_id = old('subject_id') ?? null;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.subject-context.create');
    }
}
