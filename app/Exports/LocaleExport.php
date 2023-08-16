<?php
namespace App\Exports;
use App\Models\Locale;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class LocaleExport implements FromCollection
{
    public $locales;
    public function __construct($locales) {
        $this->locales = $locales;
    }

    public function collection()
    {
        return Locale::whereIn('id', $this->locales)->get();
    }

}
