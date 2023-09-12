<?php

namespace App\Http\Livewire\TutorSkill;

use App\Http\Requests\Tutor\TutorCreateRequest;
use App\Http\Requests\Tutor\TutorUpdateRequest;
use App\Http\Requests\TutorSkill\TutorSkillCreateRequest;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Subject;
use App\Models\Tutor;
use App\Models\TutorSkill;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $tutor_id;
    public $tutors;

    public $subjects;
    public $subject_id;

    public $categories;
    public $used_categories = [0];
    public $category_id;

    public function mount()
    {
        $this->tutors = Tutor::all();
        $this->subjects = Subject::all();
    }

    protected function rules(){
        return (new TutorSkillCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->set_category();
        return view('livewire.tutor-skill.create');
    }


    protected function set_category(){
        if($this->tutor_id){
            $this->used_categories = TutorSkill::where(["tutor_id" => $this->tutor_id,"subject_id" => $this->subject_id])->pluck("category_id","category_id")->toArray();
        }
        if(count($this->used_categories) == 0){
            $this->used_categories = [0];
        }
        if($this->tutor_id && $this->subject_id){
            $this->categories = Category::whereNotIn("id",$this->used_categories)->where("subject_id",$this->subject_id)->get();
        }


    }
}
