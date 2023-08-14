<?php

namespace App\Http\Livewire\User;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
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
    protected function rules(){
        return (new UserEditRequest())->rules($this->user->id);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $this->user_id = $this->user->id;
        $this->roles = Role::all()->toArray();
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
