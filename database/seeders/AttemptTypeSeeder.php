<?php

namespace Database\Seeders;

use App\Models\AttemptType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttemptTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttemptType::create([
            'title_ru' => 'Полноценная сдача ЕНТ',
            'title_kk' => 'ҰБТ-ны толыққанды тапсыру',
            'title_en' => 'Full-fledged passing of the UNT',
        ]);
        AttemptType::create([
            'title_ru' => 'Сдача одного предмета',
            'title_kk' => 'Бір пәнді тапсыру',
            'title_en' => 'Pass one subject',
        ]);
        AttemptType::create([
            'title_ru' => 'Сдача предмета в рамках Турнира',
            'title_kk' => 'Турнир пәнін тапсыру',
            'title_en' => 'Pass Tournament Subject',
        ]);
    }
}
