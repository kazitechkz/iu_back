<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class MyTransactionDTO extends ValidatedDTO
{
    public $to_date;
    public $from_date;
    protected function rules(): array
    {
        return [
            'to_date' => 'required|date_format:d/m/Y|after:from_date',
            'from_date' => 'required|date_format:d/m/Y|before:to_date',
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
