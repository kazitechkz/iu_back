<?php

namespace App\Http\Livewire\User;

use App\Http\Requests\UserCreateRequest;
use App\Models\Gender;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $roles;
    public string $username;
    public string $name;
    public string $email;
    public $role;
    public $phone;
    public string $password;
    public $image_url;
    public $gender_id;
    public $genders;
    public $birth_date = "";

    protected function rules(){
        return (new UserCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $this->genders = Gender::all();
        $this->roles = Role::all()->toArray();
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
