<?php

namespace App\Exports;

use App\Models\Group;
use App\Models\Locale;
use Maatwebsite\Excel\Concerns\FromCollection;

class GroupExport implements FromCollection
{
    public $entities;
    public function __construct($entities) {
        $this->entities = $entities;
    }

    public function collection()
    {
        return Group::whereIn('id', $this->entities)->get();
    }

}
