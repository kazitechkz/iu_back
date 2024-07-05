<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection
{
    public $categories;
    public function __construct($categories) {
        $this->categories = $categories;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return Category::whereIn('id', $this->categories)->get();
    }
}
