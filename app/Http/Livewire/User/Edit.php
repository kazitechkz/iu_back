<?php

namespace App\Http\Livewire\User;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Gender;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $roles;
    public $user_id;
    public string $username;
    public string $name;
    public string $email;
    public $role;
    public $phone;
    public string $password;
    public User $user;
    public $image_url;
    public $gender_id;
    public $genders;
    public $birth_date;
    protected function rules(){
        return (new UserEditRequest())->rules($this->user->id);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $this->genders = Gender::all();
        $this->user_id = $this->user->id;
        $this->roles = Role::all()->toArray();
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->image_url = $this->user->image_url;
        $this->gender_id = $this->user->gender_id;
        $this->birth_date = $this->user->birth_date;
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
