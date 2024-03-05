<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AnswerResultDTO extends ValidatedDTO
{
    public bool $is_finished;
    public bool $is_answered;
    public int $question_left;
    public int $points;

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

    protected function failedValidation(): void
    {
        throw new ApiValidationException($this->validator);
    }
}
