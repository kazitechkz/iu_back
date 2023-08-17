<?php

namespace App\Http\Livewire\Subscription;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\Subscription\SubcscriptionCreateRequest;
use App\Models\User;
use Bpuig\Subby\Models\Plan;
use Livewire\Component;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Searchable\Search;

class Create extends Component
{
    public string $search = "";

    public $users;
    public $user_id;
    public $plan_id;
    public $plans;
    public string $description;

    public function mount(){
        $this->plans = Plan::all();
    }
    protected function rules(){
        return (new SubcscriptionCreateRequest)->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if(strlen($this->search)){
            $this->users = (new Search())
                ->registerModel(User::class, ['name', 'username',"phone","email"])
                ->search($this->search);
        }
        return view('livewire.subscription.create');
    }


}
