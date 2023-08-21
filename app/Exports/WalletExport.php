<?php

namespace App\Exports;

use Bavix\Wallet\Models\Wallet;
use Maatwebsite\Excel\Concerns\FromCollection;

class WalletExport implements FromCollection

{

    public $enities;



    public function __construct($enities) {

        $this->enities = $enities;

    }



    public function collection()

    {

        return Wallet::whereIn('id', $this->enities)->get();

    }

}
