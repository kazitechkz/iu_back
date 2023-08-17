<?php

namespace App\Exports;

use Bpuig\Subby\Models\Plan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlanExport implements FromCollection
{
    public $plans;
    public function __construct($plans) {
        $this->plans = $plans;
    }

    public function collection()
    {
        return Plan::whereIn('id', $this->plans)->get();
    }

}
