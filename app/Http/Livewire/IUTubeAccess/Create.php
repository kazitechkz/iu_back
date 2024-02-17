<?php

namespace App\Http\Livewire\IUTubeAccess;

use App\Http\Requests\IUTubeAccess\IUTubeAccessCreateRequest;
use App\Models\IutubeAccess;
use App\Models\Subject;
use Livewire\Component;

class Create extends Component
{
    public $subjects;
    public $subject_id;

    public $is_active;

    public function mount(){
        $subjectsID = IutubeAccess::pluck("subject_id")->toArray();
        $this->subjects = Subject::whereNotIn("id",$subjectsID)->get();
        $this->subject_id = old("subject_id");
        $this->is_active = old("is_active");
    }

    protected function rules(){
        return (new IUTubeAccessCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.i-u-tube-access.create');
    }
}
