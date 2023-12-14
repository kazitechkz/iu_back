<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class BattleStepCreateDTO extends ValidatedDTO
{
    public $battle_step_id;
    public $subject_id;

    protected function rules(): array
    {
        return [
            "battle_step_id"=>"required|exists:battle_steps,id",
            "subject_id"=>"sometimes|nullable|exists:subjects,id",
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
