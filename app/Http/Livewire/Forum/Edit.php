<?php

namespace App\Http\Livewire\Forum;

use App\Http\Requests\Forum\ForumCreateRequest;
use App\Http\Requests\Forum\ForumUpdateRequest;
use App\Models\Forum;
use App\Models\Subject;
use Livewire\Component;

class Edit extends Component
{
    public string|null $text;
    public string|null $attachment;
    public int|null $subject_id;
    public $subjects;
    public $forum;
    /**
     * Create a new component instance.
     * @param $forum
     */
    public function mount(Forum $forum){
        $this->forum = $forum;
        $this->subjects = Subject::all();
        $this->text = $this->forum->text;
        $this->attachment =$this->forum->attachment;
        $this->subject_id = $this->forum->subject_id;
    }
    protected function rules(){
        return (new ForumUpdateRequest())->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.forum.edit');
    }
}
