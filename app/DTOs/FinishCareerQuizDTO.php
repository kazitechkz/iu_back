<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FinishCareerQuizDTO extends ValidatedDTO
{

    public $quiz_id;
    public $given_answers;
    protected function rules(): array
    {
        return [
            "quiz_id"=>"required|exists:career_quizzes,id",
            "given_answers"=>"required",
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

    protected function failedValidation(): void
    {
        throw new ApiValidationException($this->validator);
    }
}
