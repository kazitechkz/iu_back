<?php

namespace App\Http\Livewire\Plan;

use App\Http\Requests\RoleCreateRequest;
use App\Models\CommercialGroup;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;

class Create extends Component
{
    public string $tag;
    public string $name;
    public string $description;
    public bool $is_active = true;
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

    public $commercial_group_id;
    public $commercial_groups;

    public function mount(){
        $this->commercial_groups = CommercialGroup::all();
        $this->tag = old("tag")??"";
        $this->name = old("name")??"";
        $this->description = old("description")??"";
        $this->is_active = old("is_active")??true;
        $this->price = old("price")??0;
         $this->signup_fee = old("signup_fee")??0;
        $this->currency = old("currency")??"KZT";
        $this->trial_period = old("price")??0;
        $this->trial_interval = old("trial_interval")??"";
        $this->trial_mode = old("trial_mode")??"";
        $this->grace_period = old("grace_period")??0;
        $this->grace_interval = old("grace_interval")??0;
        $this->invoice_period = old("invoice_period")??0;
        $this->invoice_interval = old("invoice_interval")??0;
        $this->commercial_group_id = old("commercial_group_id")??null;
        $this->tier = old("name")??"";
    }
    protected function rules(){
        $rules = (new Plan())->getRules();
        $rules["commercial_group_id"] = "required";
        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.plan.create');
    }
}
