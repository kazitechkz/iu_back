<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class WalletTransferDTO extends ValidatedDTO
{
    public $toUserId;
    public $amount;

    protected function rules(): array
    {
        return [
            "toUserId"=>"required|exists:users,id",
            "amount"=>"required|numeric|min:10|max:100000",
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
