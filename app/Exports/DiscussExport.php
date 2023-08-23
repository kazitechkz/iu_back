<?php

namespace App\Exports;

use App\Models\Discuss;
use App\Models\Forum;
use Maatwebsite\Excel\Concerns\FromCollection;

class DiscussExport implements FromCollection
{
    public $entities;
    public function __construct($entities) {
        $this->entities = $entities;
    }

    public function collection()
    {
        return Discuss::whereIn('id', $this->entities)->get();
    }

}
