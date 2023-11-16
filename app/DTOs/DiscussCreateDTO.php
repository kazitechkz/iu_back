<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class DiscussCreateDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            "forum_id"=>"required|exists:forums,id",
            "text"=>"required|min:10|max:5000"
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
