<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttemptCreateDTO extends ValidatedDTO
{
    public $subjects;
    public $locale_id;
    public $attempt_type_id;

    protected function rules(): array
    {
        return [
            "subjects"=>"required|array|min:1|max:2",
            "locale_id"=>"required|exists:locales,id",
            "attempt_type_id"=>"required|exists:attempt_types,id"
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
        throw new ApiValidationException($this->validator->errors());
    }
}
