<?php

namespace Database\Seeders;

use App\Models\Locale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locale_raw = [
            [
                'code' => 'kk',
                'title' => 'Қазақ тілі',
                'isActive' => 1
            ],
            [
                'code' => 'ru',
                'title' => 'Русский язык',
                'isActive' => 1
            ]
        ];
        foreach ($locale_raw as $value){
            if(!Locale::where(["code"=>$value["code"]])->exists()){
                Locale::create($value);
            }
        }
    }
}
