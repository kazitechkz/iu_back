<?php
namespace App\Imports\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class FirstSheetImport implements ToCollection
{
    public function collection(Collection $row)
    {
        return new User([
            "username" => $row['imia'].'_'.Str::random(5),
            'name' => $row['imia'],
            'parent_name' => $row['imia_roditelia'],
            'phone' => $row['telefon'],
            'parent_phone' => $row['nomer_roditelia'],
            'email' => $row['email'],
            'password' => bcrypt('test123'),
            "birth_date" => Carbon::create($row['data_rozdeniia']),
            "email_verified_at" => Carbon::now(),
        ]);
    }
}
