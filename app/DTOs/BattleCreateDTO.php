<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class BattleCreateDTO extends ValidatedDTO
{
    public $locale_id;
    public $pass_code;

    public $price;



    protected function rules(): array
    {
        return [
            "locale_id"=>"required|exists:locales,id",
            "pass_code"=>"sometimes|nullable",
            "price"=>"required|integer|min:10|max:1000",

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
