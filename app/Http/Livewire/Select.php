<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Select extends Component
{
    public string $name;
    public  $options;
    public string $option_label;
    public string $option_value;
    public string $label = "";
    public string $placeholder = "";
    public function render()
    {
        return view('livewire.select');
    }
}
