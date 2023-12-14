<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AnswerBattleQuestion extends ValidatedDTO
{
    public $battle_step_id;
    public $answer;
    public $question_id;


    protected function rules(): array
    {
        return [];
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
