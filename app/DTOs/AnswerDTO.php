<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AnswerDTO extends ValidatedDTO
{
    public $attempt_id;
    public $attempt_subject_id;
    public $question_id;
    public $answers;
    public $attempt_type_id;

    protected function rules(): array
    {
        return [
            "attempt_id"=>"required|exists:attempts,id",
            "attempt_subject_id"=>"required|exists:attempt_subjects,id",
            "question_id"=>"required|exists:questions,id",
            "attempt_type_id"=>"required|exists:attempt_types,id",
            "answers"=>"required|min:1"
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
