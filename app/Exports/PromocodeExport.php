<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Zorb\Promocodes\Models\Promocode;

class PromocodeExport implements FromCollection
{
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Promocode::whereIn('id', $this->items)->get();
    }
}
