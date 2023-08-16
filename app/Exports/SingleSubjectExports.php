<?php

namespace App\Exports;

use App\Models\SingleSubjectTest;
use Maatwebsite\Excel\Concerns\FromCollection;

class SingleSubjectExports implements FromCollection
{
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return SingleSubjectTest::whereIn('id', $this->items)->get();
    }
}
