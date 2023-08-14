<?php

namespace App\Http\Livewire\User;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $roles;
    public string $username;
    public string $name;
    public string $email;
    public $role;
    public $phone;
    public string $password;
    public User $user;
    protected function rules(){
        return (new UserCreateRequest())->rules();
    }

    public function mount()
    {
        $this->roles = Role::all()->toArray();
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
