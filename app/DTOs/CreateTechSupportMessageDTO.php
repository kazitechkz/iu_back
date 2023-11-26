<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CreateTechSupportMessageDTO extends ValidatedDTO
{
    public $ticket_id;
    public $message;
    public $files;
    protected function rules(): array
    {
        return [
            "ticket_id"=>"required|exists:tech_support_tickets,id",
            'message'=>"required|max:5000",
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
