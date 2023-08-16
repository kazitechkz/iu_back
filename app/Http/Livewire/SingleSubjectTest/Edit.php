<?php

namespace App\Http\Livewire\SingleSubjectTest;

use App\Http\Requests\SingleSubjectTest\CreateRequest;
use App\Models\Subject;
use Livewire\Component;

class Edit extends Component
{
    public $subjects;
    public $subject_id;
    public $single_answer_questions_quantity;
    public $contextual_questions_quantity;
    public $multi_answer_questions_quantity;
    public $allotted_time;
    public function mount($item)
    {
        $this->subject_id = $item->subject_id;
        $this->single_answer_questions_quantity = $item->single_answer_questions_quantity;
        $this->contextual_questions_quantity = $item->contextual_questions_quantity;
        $this->multi_answer_questions_quantity = $item->multi_answer_questions_quantity;
        $this->allotted_time = $item->allotted_time;
        $this->subjects = Subject::all();
    }

    protected function rules(): array
    {
        return (new CreateRequest())->rules();
    }

    protected function validationAttributes (): array
    {
        return (new CreateRequest())->attributes();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.single-subject-test.edit');
    }
}
