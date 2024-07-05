<?php

namespace App\Exports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubCategoriesExport implements FromCollection
{
    public $subCategories;
    public function __construct($subCategories) {
        $this->subCategories = $subCategories;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return SubCategory::whereIn('id', $this->subCategories)->get();
    }
}
