<?php

namespace App\Http\Livewire\Wallet;

use Bavix\Wallet\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;

class WalletIndexTable extends Component
{
    use WithPagination;
    public $searchTerm;
    public function render()
    {
        $wallets = Wallet::whereHas('holder', function ($query) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%')->orWhere('email', 'like', '%' . $this->searchTerm . '%');
        })->paginate(10);
        return view('livewire.wallet.wallet-index-table', ['wallets' => $wallets]);
    }
}
