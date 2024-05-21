<?php

namespace App\Imports;

use App\Models\UrlPage;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class UrlPageImport implements ToModel
{
    public function model(array $row)
    {
        return new UrlPage([
            'title'     => $row[0],
            'url'    => $row[1]
        ]);
    }
}
