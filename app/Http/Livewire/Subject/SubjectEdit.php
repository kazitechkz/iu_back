<?php

namespace App\Http\Livewire\Subject;

use App\Http\Requests\Subject\SubjectEditRequest;
use Livewire\Component;

class SubjectEdit extends Component
{
    public $title_kk;
    public $title_ru;
    public $is_compulsory;
    public $max_questions_quantity = 0;

    public function mount($subject)
    {
        $this->title_kk = $subject->title_kk;
        $this->title_ru = $subject->title_ru;
        $this->max_questions_quantity = $subject->max_questions_quantity;
        $this->is_compulsory = $subject->is_compulsory;
    }
    protected function rules(): array
    {
        return (new SubjectEditRequest())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.subject.subject-edit');
    }
}
