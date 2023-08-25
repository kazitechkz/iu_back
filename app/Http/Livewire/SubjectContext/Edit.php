<?php

namespace App\Http\Livewire\SubjectContext;

use App\Models\Subject;
use Livewire\Component;

class Edit extends Component
{
    public $subjects;
    public int|null $subject_id;
    public $context;

    public function mount($ctx): void
    {
        $this->subjects = Subject::all();
        $this->subject_id = $ctx->subject_id;
        $this->context = $ctx->context;
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.subject-context.edit');
    }
}
