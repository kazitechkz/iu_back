<?php

namespace App\Http\Livewire\Permission;

use App\Http\Requests\PermissionUpdateRequest;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $name = "";
    public $guard_name = "";
    public Permission $permission;

    protected function rules(){
        return (new PermissionUpdateRequest())->rules();
    }

    public function mount()
    {
        $this->name = $this->permission->name;
        $this->guard_name = $this->permission->guard_name;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.permission.edit');
    }
}
