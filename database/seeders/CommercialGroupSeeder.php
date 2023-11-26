<?php

namespace Database\Seeders;

use App\Models\CommercialGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommercialGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commercial_group_raw = [
            [
                'title_ru'=>"Тренажер для ЕНТ",
                'title_kk'=>"Тренажер для ЕНТ",
                'tag'=>"unt",
                'is_active'=>true,
            ],
            [
                'title_ru'=>"Учебный материал",
                'title_kk'=>"Учебный материал",
                'tag'=>"content",
                'is_active'=>true
            ]

        ];
        foreach ($commercial_group_raw as $value){
            if(!CommercialGroup::where(["title_ru"=>$value["title_ru"]])->exists()){
                CommercialGroup::create($value);
            }
        }
    }
}
