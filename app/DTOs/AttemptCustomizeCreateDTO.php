<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttemptCustomizeCreateDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            "subject_id"=>"required|exists:subjects,id",
            "locale_id"=>"required|exists:locales,id",
            "attempt_type_id"=>"required|exists:attempt_types,id",
            "category_ids"=>"sometimes|nullable|array|min:1|max:10",
            "sub_category_ids"=>"sometimes|nullable|array|min:1|max:10",
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
        throw new ApiValidationException($this->validator->errors());
    }
}
