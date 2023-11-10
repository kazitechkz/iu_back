<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttemptSettingsCreateDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            'settings' => 'required',
            'locale_id' => 'required|exists:locales,id',
            'time' => 'required|number|max:300|min:1',
            'hidden_fields' => 'required',
            'point' => 'required|number'
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
