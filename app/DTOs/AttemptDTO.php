<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttemptDTO extends ValidatedDTO
{
    public $attempt_id;
    public $time;
    public $is_finished = false;
    public $subject_questions;

    protected function rules(): array
    {
        return [

        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [
        ];
    }
    protected function failedValidation(): void
    {
    }
}
