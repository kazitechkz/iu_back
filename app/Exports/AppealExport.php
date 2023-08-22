<?php

namespace App\Exports;

use App\Models\Appeal;
use App\Models\AppealType;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppealExport  implements FromCollection
{
    public $entities;

    public function __construct($entities)
    {
        $this->entities = $entities;
    }

    public function collection()
    {
        return Appeal::whereIn('id', $this->entities)->get();
    }
}

