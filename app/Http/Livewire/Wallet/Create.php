<?php

namespace App\Http\Livewire\Wallet;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Searchable\Search;

class Create extends Component
{

    public $amount;
    public $exchange;
    public $searchFirst;
    public $searchSecond;
    public $usersGroupOne;
    public $usersGroupTwo;
    public $userOneId = 0;
    public $userTwoId = 0;

    public $userFrom;
    public $userTo;

    public $exchanges;
    public function mount(){
        $this->exchanges =[
            ["name"=>"One User","value"=>"transaction"],
            ["name"=>"From one to other user","value"=>"transfer"],
        ];
    }


    public function render()
    {
        $this->searchUsers();
        $this->findUser();
        return view('livewire.wallet.create');
    }


    public function transaction(){
        if($this->userFrom){
            if($this->amount > 0){
                $this->userFrom->deposit($this->amount);
                toastr()->info("Сумма пополнена на " . $this->amount);
            }
            if($this->amount < 0 && abs($this->amount) <= $this->userFrom->balance){
                $this->userFrom->withdraw(abs($this->amount));
                toastr()->warning("Сумма снятия на " . $this->amount);
            }
            $this->userFrom->wallet->refreshBalance();
        }
    }

    public function transfer(){
        if($this->userFrom && $this->userTo){
            if($this->userFrom->balance >= $this->amount){
                $this->userFrom->transfer($this->userTo, $this->amount);
                toastr()->info("Сумма трансфера на " . $this->amount);
                $this->userFrom->wallet->refreshBalance();
                $this->userTo->wallet->refreshBalance();
            }
        }
    }

    protected function searchUsers(){
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
    }

    protected function findUser(){
        if($this->userOneId){
            $this->userFrom = User::find($this->userOneId);
        }
        if($this->userTwoId){
            $this->userTo = User::find($this->userTwoId);
        }

    }
}
