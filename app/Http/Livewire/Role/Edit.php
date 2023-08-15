<?php

namespace App\Http\Livewire\Role;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $name = "";
    public $guard_name = "";
    public Role $role;
    public $permissions;
    public $permissionGroup = [];
    protected function rules(){
        return (new RoleUpdateRequest())->rules();
    }

    public function changePermission($name){
        if(in_array($name,$this->permissionGroup)){
            $this->role->hasPermissionTo($name) ? null : $this->role->givePermissionTo($name);
        }
        else{
            $this->role->hasPermissionTo($name) ? $this->role->revokePermissionTo($name) : null;
        }

    }

    public function mount()
    {
        $this->permissions = Permission::all();
        $this->name = $this->role->name;
        $this->guard_name = $this->role->guard_name;
        $this->permissionGroup = $this->role->getPermissionNames();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.role.edit');
    }
}
