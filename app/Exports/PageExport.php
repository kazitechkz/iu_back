<?php

namespace App\Exports;

use App\Models\News;
use App\Models\Page;
use Maatwebsite\Excel\Concerns\FromCollection;

class PageExport implements FromCollection
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
        return Page::whereIn('id', $this->items)->get();
    }
}
