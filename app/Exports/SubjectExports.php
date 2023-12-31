<?php

namespace App\Exports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubjectExports implements FromCollection
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
        return Subject::whereIn('id', $this->items)->get();
    }
}
