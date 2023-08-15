<?php

namespace App\Http\Livewire\Role;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\UserCreateRequest;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{

    public $name = "";
    public $guard_name = "";
    public $permissions;
    public function mount(){
          $this->name = old("name");
          $this->guard_name = old("guard_name");
          $this->permissions = Permission::all();
    }
    protected function rules(){
        return (new RoleCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.role.create');
    }
}
