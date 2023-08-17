<?php

namespace App\Http\Livewire\Subscription;

use App\Http\Requests\Subscription\SubcscriptionCreateRequest;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Livewire\Component;

class Edit extends Component
{
    public $plan_id;
    public $users;
    public PlanSubscription $subscription;
    public $plans;
    public string $description;
    public $user_id;
    public $user;
    public bool $agree = false;
    protected function rules(){
        return (new SubcscriptionCreateRequest)->rules();
    }
    public function mount(){
        $this->plans = Plan::where(["id"=>$this->subscription->plan_id])->get();
        $this->plan_id = $this->subscription->plan_id;
        $this->users = $this->subscription->subscriber()->get();
        $this->user_id = ($this->subscription->subscriber()->first())->id;
        $this->user = $this->users->first();
    }

    public function changeSubscription($type){
        switch ($type){
            case "renew":
                $this->user->subscription($this->subscription->tag)->renew();
                break;
            case "cancel":
                $this->user->subscription($this->subscription->tag)->cancel(true);
                break;
            case "uncancel":
                $this->user->subscription($this->subscription->tag)->uncancel();
                break;
            default:
                return true;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.subscription.edit');
    }
}
