<?php

namespace App\Http\Livewire\IUTubeAccess;

use App\Http\Requests\IUTubeAccess\IUTubeAccessEditRequest;
use App\Models\IutubeAccess;
use App\Models\Subject;
use Livewire\Component;

class Edit extends Component
{
    public $access;
    public $subjects;
    public $subject_id;

    public $is_active;

    public function mount(IutubeAccess $access){
        $this->access = $access;
        $this->subjects = Subject::where("id",$access->subject_id)->get();
        $this->subject_id = $access->subject_id;
        $this->is_active = $access->is_active;
    }

    protected function rules(){
        return (new IUTubeAccessEditRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.i-u-tube-access.edit');
    }
}
