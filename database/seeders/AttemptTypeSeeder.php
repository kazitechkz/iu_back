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
        $attempt_types_raw = [
            [
                'id'=>1,
                'title_ru' => 'Полноценная сдача ЕНТ',
                'title_kk' => 'ҰБТ-ны толыққанды тапсыру',
                'title_en' => 'Full-fledged passing of the UNT',
            ],
            [
                'id'=>2,
                'title_ru' => 'Сдача одного предмета',
                'title_kk' => 'Бір пәнді тапсыру',
                'title_en' => 'Pass one subject',
            ],
            [
                'id'=>3,
                'title_ru' => 'Сдача предмета в рамках Турнира',
                'title_kk' => 'Турнир пәнін тапсыру',
                'title_en' => 'Pass Tournament Subject',
            ],
            [
                'id'=>4,
                'title_ru' => 'Сдача предмета по заданным настройкам',
                'title_kk' => 'Берілген параметрлер бойынша пән тестінен өту',
                'title_en' => 'Passing the test of the subject according to the specified settings',
            ],
            [
                'id'=>5,
                'title_ru' => 'Сдача ЕНТ по заданным настройкам',
                'title_kk' => 'Берілген параметрлер бойынша ҰБТ тестінен өту',
                'title_en' => 'Passing the UNT according to the specified settings',
            ]
        ];
        foreach ($attempt_types_raw as $attempt_type){
            if(!AttemptType::where(["title_ru"=>$attempt_type["title_ru"]])->exists()){
                AttemptType::create($attempt_type);
            }
        }

    }
}
