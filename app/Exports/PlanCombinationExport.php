<?php

namespace App\Exports;

use Bpuig\Subby\Models\PlanCombination;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlanCombinationExport implements FromCollection
{
    public PlanCombination $plan_combinations;
    public function __construct($plan_combinations) {
        $this->plan_combinations = $plan_combinations;
    }

    public function collection()
    {
        return PlanCombination::whereIn('id', $this->plan_combinations)->get();
    }

}
