<?php

namespace App\Exports;

use App\Models\AppealType;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppealTypeExport implements FromCollection
{
    public $entities;

    public function __construct($entities)
    {
        $this->entities = $entities;
    }

    public function collection()
    {
        return AppealType::whereIn('id', $this->entities)->get();
    }
}
