<?php

namespace App\Http\Livewire\Plan;

use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Edit extends Component
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

    public $invoice_period;

    public $invoice_interval;
    public $tier;
    public Plan $plan;

    public function mount(){
        $this->tag = $this->plan->tag;
        $this->name = $this->plan->name;
        $this->description = $this->plan->description;
        $this->is_active = $this->plan->is_active;
        $this->price = $this->plan->price;
        $this->signup_fee =  $this->plan->signup_fee;
        $this->currency = $this->plan->currency;
        $this->trial_period = $this->plan->trial_period;
        $this->trial_interval = $this->plan->trial_interval;
        $this->trial_mode = $this->plan->trial_mode;
        $this->grace_period = $this->plan->grace_period;
        $this->grace_interval = $this->plan->grace_interval;
        $this->invoice_period = $this->plan->invoice_period;
        $this->invoice_interval = $this->plan->invoice_interval;
        $this->tier = $this->plan->tier;
    }
    protected function rules(){
        $rules = (new Plan())->getRules();
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.plan.edit');
    }
}
