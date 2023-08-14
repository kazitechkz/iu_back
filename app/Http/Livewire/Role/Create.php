<?php

namespace App\Http\Livewire\Role;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\UserCreateRequest;
use Livewire\Component;

class Create extends Component
{

    public $name = "";
    public $guard_name = "";

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
