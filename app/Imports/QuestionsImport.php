<?php

namespace App\Imports;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class QuestionsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|Question|null
     */
    public function model(array $row): Model|Question|null
    {
        return new Question([
            'text' => $row['text'],
            'answer_a' => $row['answer_a'],
            'answer_b' => $row['answer_b'],
            'answer_c' => $row['answer_c'],
            'answer_d' => $row['answer_d'],
            'correct_answers' => $row['correct_answers'],
            'type_id' => 1,
            'subject_id' => $row['subject_id'],
            'locale_id' => $row['locale_id'],
            'group_id' => 1,
        ]);
    }
}
