<?php

namespace App\Http\Livewire\Permission;

use App\Http\Requests\PermissionCreateRequest;
use Livewire\Component;

class Create extends Component
{
    public $name = "";
    public $guard_name = "";

    protected function rules(){
        return (new PermissionCreateRequest())->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.permission.create');
    }
}
