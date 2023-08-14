<?php

namespace App\Exports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubjectExports implements FromCollection
{
    public $subjects;

    public function __construct($subjects)
    {
        $this->subjects = $subjects;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subject::whereIn('id', $this->subjects)->get();
    }
}
