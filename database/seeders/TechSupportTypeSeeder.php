<?php

namespace Database\Seeders;

use App\Models\TechSupportType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechSupportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tech_support_type_raw = [
            [
                "id"=>1,
                "title_ru"=>"Техническая проблема",
                "title_kk"=>"Техникалық мәселе",
                "title_en"=>"Technical problem",
            ],
            [
                "id"=>2,
                "title_ru"=>"Финансовая проблема",
                "title_kk"=>"Қаржылық мәселе",
                "title_en"=>"Financial problem",
            ],
            [
                "id"=>3,
                "title_ru"=>"Проблема с тренажером",
                "title_kk"=>"Тренажер мәселесі",
                "title_en"=>"Problem with the simulator",
            ],
            [
                "id"=>4,
                "title_ru"=>"Проблема с материалами обучения",
                "title_kk"=>"Оқу материалдарына қатысты мәселе",
                "title_en"=>"Problem with learning materials",
            ],
            [
                "id"=>5,
                "title_ru"=>"Проблема с платформой",
                "title_kk"=>"Платформа мәселесі",
                "title_en"=>"The problem with the platform",
            ],
        ];
        foreach ($tech_support_type_raw as $tech_supports){
            if($type = TechSupportType::where(["id"=>$tech_supports["id"]])->first()){
                if($type->title_ru != $tech_supports["title_ru"]){
                    unset($tech_supports["id"]);
                    $type->edit($tech_supports);
                }
            }
            else{
                TechSupportType::create($tech_supports);
            }

        }
    }
}
