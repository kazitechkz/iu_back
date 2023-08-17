<?php

namespace App\Exports;

use App\Models\Subject;
use Bpuig\Subby\Models\PlanSubscription;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubscriptionExport implements FromCollection
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
        return PlanSubscription::whereIn('id', $this->items)->with("subscriber")->get();
    }
}
