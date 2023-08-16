<?php

namespace App\Http\Livewire\Plan;

use Livewire\Component;

class Create extends Component
{
    public string $tag;
    public string $name;
    public string $description;
    public bool $is_active;
    public $price;
    public $signup_fee;
    public string $currency;
    public $trial_period;
    public $trial_interval;
    public $trial_mode;
    public $grace_period;
    public $grace_interval;

    public function render()
    {
        return view('livewire.plan.create');
    }
}
