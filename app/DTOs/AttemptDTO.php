<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use Illuminate\Validation\ValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttemptDTO extends ValidatedDTO
{
    public $attempt_id;
    public $type_id;
    public $time_left;
    public $is_finished = false;
    public $subject_questions;
    public $start_at;


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
        throw new ApiValidationException($this->validator);
    }
}
