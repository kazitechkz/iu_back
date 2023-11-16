<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class FindUserByEmailDTO extends ValidatedDTO
{
    public string $email;

    protected function rules(): array
    {
        return [
            "email"=>"required|email"
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
