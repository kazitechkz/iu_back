<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question_type_raw = [
            [
                'title_ru' => 'Вопрос с 1 ответом',
                'title_kk' => '1 жауабы бар сұрақ',
            ],
            [
                'title_ru' => 'Контекстный',
                'title_kk' => 'Мәтінмәндік',
            ],
            [
                'title_ru' => 'Вопрос с несколькими ответами',
                'title_kk' => 'Көп жауап беретін сұрақ',
            ]
        ];
        foreach ($question_type_raw as $value){
            if(!QuestionType::where(["title_ru"=>$value["title_ru"]])->exists()){
                QuestionType::create($value);
            }
        }
    }
}
