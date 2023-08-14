<?php

namespace App\Http\Livewire\Subject;

use App\Http\Requests\SubjectCreateRequest;
use Livewire\Component;

class SubjectCreate extends Component
{
    public $title_kk;
    public $title_ru;
    public $is_compulsory;
    public $max_questions_quantity = 0;

    protected function rules(): array
    {
        return (new SubjectCreateRequest())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.subjects.create');
    }
}
