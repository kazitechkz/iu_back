<?php

namespace App\Http\Livewire\Forum;

use App\Http\Requests\Forum\ForumCreateRequest;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{

    public string|null $text;
    public string|null $attachment;
    public int|null $subject_id;
    public $subjects;

    public function mount(){
        $this->subjects = Subject::all();
        $this->text = old("text")??"";
        $this->attachment = old("attachment")??"";
        $this->subject_id = old("subject_id")??null;
    }
    protected function rules(){
        return (new ForumCreateRequest())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.forum.create');
    }
}
