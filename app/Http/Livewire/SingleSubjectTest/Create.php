<?php

namespace App\Http\Livewire\SingleSubjectTest;

use App\Http\Requests\SingleSubjectTest\CreateRequest;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public $subjects;
    public $subject_id;
    public $single_answer_questions_quantity;
    public $contextual_questions_quantity;
    public $multi_answer_questions_quantity;
    public $allotted_time;

    protected function rules(): array
    {
        return (new CreateRequest())->rules();
    }

    protected function validationAttributes (): array
    {
        return (new CreateRequest())->attributes();
    }
    public function mount()
    {
        $this->subjects = Subject::all();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.single-subject-test.create');
    }
}
