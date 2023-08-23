<?php

namespace App\Exports;

use App\Models\Forum;
use App\Models\Group;
use Maatwebsite\Excel\Concerns\FromCollection;

class ForumExport implements FromCollection
{
    public $entities;
    public function __construct($entities) {
        $this->entities = $entities;
    }

    public function collection()
    {
        return Forum::whereIn('id', $this->entities)->get();
    }

}
