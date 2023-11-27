<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CreateTechSupportTicketDTO extends ValidatedDTO
{
    public $type_id;
    public $category_id;
    public $title;
    public $message;
    public $files;

    protected function rules(): array
    {
        return [
            "type_id"=>"required|exists:tech_support_types,id",
            "category_id"=>"required|exists:tech_support_categories,id",
            'title'=>"required|max:255",
            'message'=>"required",
            "files"=>"sometimes|nullable|array|max:5",
            "files.*"=>"exists:files,id",
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
