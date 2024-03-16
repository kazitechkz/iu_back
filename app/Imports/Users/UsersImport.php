<?php

namespace App\Imports\Users;

use App\Imports\Users\FirstSheetImport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UsersImport implements ToModel, WithUpserts, WithHeadingRow, WithMultipleSheets, WithChunkReading
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
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

    public function uniqueBy()
    {
        return ['email', 'phone'];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function chunkSize(): int
    {
        return 20;
    }
}
