<?php

namespace App\Http\Livewire\Tutor;

use App\Http\Requests\SubTournament\SubTournamentCreateRequest;
use App\Http\Requests\Tutor\TutorCreateRequest;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Searchable\Search as SearchModel;

class Create extends Component
{
    public $search = "";
    public $users;
    public $roles = [];
    public $user_id;
    public $user;
    public bool $loading = false;

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

    public $subjects;
    public $subject_id;

    public $categories;
    public $category_id;


    public function mount()
    {
        if($role = Role::where(["name"=>"tutor"])->first()){
            $this->roles = DB::table("model_has_roles")->where("role_id",$role->id)->pluck("model_id","model_id")->toArray();
        }
        $this->subjects = Subject::all();
        $this->loading = false;
        $this->genders = Gender::all();
        $this->search = old("search")??"";
        $this->gender_id = old("gender_id");
        $this->phone = old("phone")??"";
        $this->email = old("email")??"";
        $this->iin = old("iin")??"";
        $this->bio = old("bio")??"";
        $this->experience = old("experience")??"";
        $this->is_proved = old("is_proved")??false;
        $this->birth_date = old("birth_date");
    }


    public function render()
    {
        $this->change_subject();
        return view('livewire.tutor.create');
    }

    public function select_user($id){
        $this->user_id = $id;
        $this->user = User::find($id);
        $this->email =  $this->user->email;
        $this->phone =  $this->user->phone;
    }

    protected function rules(){
        return (new TutorCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function search_user(){
        if(strlen($this->search) >= 3){
            $this->loading = true;
            $this->users = (new SearchModel())
                ->registerModel(User::class, ['name', 'username',"phone","email"])
                ->limitAspectResults(50)
                ->search($this->search);
            $this->loading = false;
        }
    }

    protected function change_subject(){
        if($this->subject_id){
            $this->categories = Category::whereIn("subject_id",$this->subject_id)->get();
        }
        else{
            $this->categories = null;
            $this->category_id = [];
        }
    }
}
