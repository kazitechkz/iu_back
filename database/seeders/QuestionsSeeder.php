<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = File::get(storage_path('assets/sql/questions.json'));
        $questions = json_decode($file);
        foreach ($questions as $data) {
            Question::create([
                'id' => $data->id,
                'text' => $data->text,
                'context_id' => $data->context_id,
                'answer_a' => $data->answer_a,
                'answer_b' => $data->answer_b,
                'answer_c' => $data->answer_c,
                'answer_d' => $data->answer_d,
                'answer_e' => $data->answer_e,
                'answer_f' => $data->answer_f,
                'answer_g' => $data->answer_g,
                'answer_h' => $data->answer_h,
                'correct_answers' => $data->correct_answers,
                'prompt' => $data->prompt,
                'explanation' => $data->explanation,
                'locale_id' => $data->locale_id == 1 ? 2 : 1,
                'subject_id' => $data->subject_id,
                'type_id' => $data->type_id,
                'group_id' => 3,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at
            ]);
        }
    }
}
