<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            'title_ru' => 'Математическая грамотность',
            'title_kk' => 'Математикалық сауаттылық',
            'is_compulsory' => true,
            'max_questions_quantity' => 15,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 1,
            'single_answer_questions_quantity' => 15,
            'contextual_questions_quantity' => 0,
            'multi_answer_questions_quantity' => 0,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'История Казахстана',
            'title_kk' => 'Қазақстан тарихы',
            'is_compulsory' => true,
            'max_questions_quantity' => 15,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 2,
            'single_answer_questions_quantity' => 10,
            'contextual_questions_quantity' => 10,
            'multi_answer_questions_quantity' => 0,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Грамотность чтения',
            'title_kk' => 'Оқу сауаттылығы',
            'is_compulsory' => true,
            'max_questions_quantity' => 20,
            'questions_step' => 2,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 3,
            'single_answer_questions_quantity' => 0,
            'contextual_questions_quantity' => 20,
            'multi_answer_questions_quantity' => 0,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Математика',
            'title_kk' => 'Математика',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 4,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Физика',
            'title_kk' => 'Физика',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 5,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Химия',
            'title_kk' => 'Химия',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 6,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Биология',
            'title_kk' => 'Биология',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 7,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'География',
            'title_kk' => 'География',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 8,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Всемирная история',
            'title_kk' => 'Дүниежүзі тарихы',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 9,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Основы права',
            'title_kk' => 'Құқық',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 10,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Английский язык',
            'title_kk' => 'Ағылшын тілі',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 11,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Казахский язык',
            'title_kk' => 'Қазақ тілі',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 12,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Казахская литература',
            'title_kk' => 'Қазақ әдебиеті',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 13,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Русский язык',
            'title_kk' => 'Орыс тілі',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 14,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);

        DB::table('subjects')->insert([
            'title_ru' => 'Русская литература',
            'title_kk' => 'Орыс әдебиеті',
            'max_questions_quantity' => 35,
            'questions_step' => 5,
        ]);

        DB::table('single_subject_tests')->insert([
            'subject_id' => 15,
            'single_answer_questions_quantity' => 20,
            'contextual_questions_quantity' => 5,
            'multi_answer_questions_quantity' => 10,
        ]);
    }
}
