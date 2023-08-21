<?php

namespace App\Http\Livewire\Wallet;

use App\Models\User;
use Livewire\Component;
use Spatie\Searchable\Search;

class Create extends Component
{

    public $amount;
    public $exchangeType;
    public $searchFirst;
    public $searchSecond;
    public $usersGroupOne;
    public $usersGroupTwo;
    public $userOne;
    public $userTwo;

    public $exchanges = [
      ["name"=>"One User","value"=>"transaction"],
      ["name"=>"From one to other user","value"=>"transfer"],

    ];

    public function render()
    {
        if(strlen($this->searchFirst)){
            $this->usersGroupOne = (new Search())
                ->registerModel(User::class, ['name', 'username',"phone","email"])
                ->search($this->searchFirst);
        }
        if(strlen($this->searchSecond)){
            $this->usersGroupTwo = (new Search())
                ->registerModel(User::class, ['name', 'username',"phone","email"])
                ->search($this->searchSecond);
        }

        return view('livewire.wallet.create');
    }
}
