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
        CommercialGroup::create([
            'title_ru'=>"Тренажер для ЕНТ",
            'title_kk'=>"Тренажер для ЕНТ",
            'tag'=>"unt",
            'is_active'=>true,
        ]);
        CommercialGroup::create([
            'title_ru'=>"Учебный материал",
            'title_kk'=>"Учебный материал",
            'tag'=>"content",
            'is_active'=>true
        ]);
    }
}
