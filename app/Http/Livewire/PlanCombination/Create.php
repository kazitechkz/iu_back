<?php

namespace App\Http\Livewire\PlanCombination;

use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanCombination;
use Livewire\Component;

class Create extends Component
{
    public $plans;
    public $plan_id;
    public string $tag;
    public string $country;
    public string $currency;
    public float $price;
    public float $signup_fee;
    public $invoice_period;
    public string $invoice_interval;

    public function mount(){
       $this->plans = Plan::where(["is_active"=>true])->get();
       $this->tag = old("tag") ?? "";
       $this->country = old("country") ?? "";
       $this->currency = old("currency") ?? "";
       $this->price = old("price") ?? 0;
       $this->signup_fee = old("signup_fee") ?? 0;
       $this->invoice_period = old("invoice_period") ?? 1;
       $this->invoice_interval = old("invoice_interval") ?? "";

    }
    protected function rules(){
        return (new PlanCombination())->getRules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.plan-combination.create');
    }
}
