<?php

namespace App\Http\Livewire\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Subject;
use Livewire\Component;

class Edit extends Component
{
    public $subjects;
    public $subject_id;
    public $title_kk;
    public $title_ru;

    protected function rules(): array
    {
        return (new CategoryRequest())->rules();
    }

    protected function validationAttributes (): array
    {
        return (new CategoryRequest())->attributes();
    }
    public function mount($item)
    {
        $this->subject_id = $item->subject_id;
        $this->title_kk = $item->title_kk;
        $this->title_ru = $item->title_ru;
        $this->subjects = Subject::all();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.category.edit');
    }
}
