<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CategoryQuestionCountDTO extends ValidatedDTO
{
    public $category_id;
    public $locale_id;


    protected function rules(): array
    {
        return [
            "category_id"=>"required|exists:categories,id",
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
}
