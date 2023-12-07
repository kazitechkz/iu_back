<?php

namespace Database\Seeders;

use App\Models\AppealType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appeal_types = [
            [
                "id"=>1,
                "title_ru"=>"В ответе ошибки",
                "title_kk"=>"Жауапта қателер бар",
                "title_en"=>"There are errors in the response",
                "isActive"=>true
            ],
            [
                "id"=>2,
                "title_ru"=>"В вопросе имеются ошибки",
                "title_kk"=>"Сұрақта қателер бар",
                "title_en"=>"There are errors in the question",
                "isActive"=>true
            ],
            [
                "id"=>3,
                "title_ru"=>"В подсказке имеются ошибки",
                "title_kk"=>"Кеңесте қателер бар",
                "title_en"=>"There are errors in the hint",
                "isActive"=>true
            ],
            [
                "id"=>4,
                "title_ru"=>"В решении имеются ошибки",
                "title_kk"=>"Шешімде қателер бар",
                "title_en"=>"There are errors in the solution",
                "isActive"=>true
            ],
            [
                "id"=>5,
                "title_ru"=>"Техническая ошибка",
                "title_kk"=>"Техникалық қате",
                "title_en"=>"Technical error",
                "isActive"=>true
            ],
        ];
        foreach ($appeal_types as $value){
            if($appealType = AppealType::where(["id"=>$value["id"]])->first()){
                if($appealType->title_ru != $value["title_ru"]){
                    unset($value["id"]);
                    $appealType->edit($value);
                }
            }
            else{
                AppealType::create($value);
            }
        }
    }
}
