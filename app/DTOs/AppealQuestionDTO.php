<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AppealQuestionDTO extends ValidatedDTO
{
    public $user_id;
    public $type_id;
    public $question_id;
    public $message;

    protected function rules(): array
    {
        return [
            "user_id"=>"required|exists:users,id",
            "type_id"=>"required|exists:appeal_types,id",
            "question_id"=>"required|exists:questions,id",
            "message"=>"sometimes|max:255",
        ];
    }

    protected function defaults(): array
    {
        return [
            "user_id" => auth()->guard("api")->id()
        ];
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
