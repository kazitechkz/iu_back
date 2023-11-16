<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class SubTournamentCreateDTO extends ValidatedDTO
{
    public $locale_id;
    public $sub_tournament_id;
    protected function rules(): array
    {
        return [
            "locale_id"=>"required|exists:locales,id",
            "sub_tournament_id"=>"required|exists:sub_tournaments,id"
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
