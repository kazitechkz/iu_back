<?php

namespace App\Http\Livewire\Tutor;

use App\Http\Requests\Tutor\TutorCreateRequest;
use App\Http\Requests\Tutor\TutorUpdateRequest;
use App\Models\Gender;
use App\Models\Subject;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $image_url;
    public $gender_id;
    public $genders;
    public $phone;
    public $email;
    public $iin;
    public $bio;
    public $experience;
    public $skills;
    public bool $is_proved;
    public $birth_date;

    public $tutor;
    public $tutor_id;
    public function mount(Tutor $tutor)
    {
        $this->tutor = $tutor;
        $this->tutor_id = $tutor->id;
        $this->genders = Gender::all();
        $this->gender_id = $tutor->gender_id;
        $this->phone = $tutor->phone;
        $this->email = $tutor->email;
        $this->iin = $tutor->iin;
        $this->bio = $tutor->bio;
        $this->experience = $tutor->experience;
        $this->is_proved = $tutor->is_proved;
        $this->birth_date = $tutor->birth_date;
    }


    protected function rules(){
        return (new TutorUpdateRequest())->rules($this->tutor_id);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.tutor.edit');
    }
}
