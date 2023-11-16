<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ForumCreateDTO extends ValidatedDTO
{

    public string $text;
    public string $attachment;
    public string $subject_id;
    public $files = [];
    protected function rules(): array
    {
        return [
            "text"=>"required|max:255",
            "attachment"=>"required|max:5000",
            "subject_id"=>"required|exists:subjects,id",
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
