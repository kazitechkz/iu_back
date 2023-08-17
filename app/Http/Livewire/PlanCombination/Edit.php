<?php

namespace App\Http\Livewire\PlanCombination;

use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanCombination;
use Livewire\Component;

class Edit extends Component
{
    public $plans;
    public PlanCombination $planCombination;
    public $plan_id;
    public string $tag;
    public string $country;
    public string $currency;
    public float $price;
    public float $signup_fee;
    public $invoice_period;
    public string $invoice_interval;

    public function mount(){
        $this->plan_id = $this->planCombination->plan_id;
        $this->plans = Plan::where(["is_active"=>true,"id"=>$this->plan_id])->get();
        $this->tag = $this->planCombination->tag;
        $this->country = $this->planCombination->country;
        $this->currency = $this->planCombination->currency;
        $this->price = $this->planCombination->price;
        $this->signup_fee = $this->planCombination->signup_fee;
        $this->invoice_period = $this->planCombination->invoice_period;
        $this->invoice_interval = $this->planCombination->invoice_interval;

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
        return view('livewire.plan-combination.edit');
    }
}
