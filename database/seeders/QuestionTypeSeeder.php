<?php

namespace Database\Seeders;

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
        DB::table('question_types')->insert([
            'title_ru' => 'Вопрос с 1 ответом',
            'title_kk' => '1 жауабы бар сұрақ',
        ]);
        DB::table('question_types')->insert([
            'title_ru' => 'Контекстный',
            'title_kk' => 'Мәтінмәндік',
        ]);
        DB::table('question_types')->insert([
            'title_ru' => 'Вопрос с несколькими ответами',
            'title_kk' => 'Көп жауап беретін сұрақ',
        ]);
        DB::table('question_types')->insert([
        'title_ru' => 'Настраиваемый тест для одного предмета',
        'title_kk' => 'Бір пән үшін теңшелетін мәтін',
    ]);
    }
}
