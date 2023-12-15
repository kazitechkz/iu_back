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
        return [
            "battle_step_id"=>"exists:battle_steps,id",
            "answer"=>"required",
            "question_id"=>"required|exists:questions,id",
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
