<?php

namespace App\Http\Livewire\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
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
    public function mount(): void
    {
        $this->subjects = Subject::all();
    }
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.category.create');
    }
}
