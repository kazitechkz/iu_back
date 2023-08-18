<?php

namespace App\Exports;

use App\Models\News;
use Maatwebsite\Excel\Concerns\FromCollection;
use Zorb\Promocodes\Models\Promocode;

class NewsExport implements FromCollection
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
        return News::whereIn('id', $this->items)->get();
    }
}
