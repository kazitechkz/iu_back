<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class SubCategoryQuestionCountDTO extends ValidatedDTO
{
    public $sub_category_id;
    public $locale_id;


    protected function rules(): array
    {
        return [
            "sub_category_id"=>"required|exists:sub_categories,id",
            "locale_id"=>"required|exists:locales,id"
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
