<?php

namespace App\Http\Livewire\Role;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $name = "";
    public $guard_name = "";
    public Role $role;

    protected function rules(){
        return (new RoleUpdateRequest())->rules();
    }

    public function mount()
    {
        $this->name = $this->role->name;
        $this->guard_name = $this->role->guard_name;
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
