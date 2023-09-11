<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AnswerResultDTO extends ValidatedDTO
{
    public bool $is_finished;
    public bool $is_answered;
    public int $question_left;

    public $question_id;

    public $time_left;


    protected function rules(): array
    {
        return [];
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
