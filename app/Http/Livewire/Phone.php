<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Phone extends Component
{
    public  $phone = "";
    public string  $label = "Phone";
    public string  $hint = "Please inter your phone";
    public string  $name = "phone";
    public string  $mask = "['+7(7##)###-##-##']";
    public string  $icon = "phone";
    public function render()
    {
        return view('livewire.phone');
    }
}
