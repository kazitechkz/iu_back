<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class SubjectQuestionDTO extends ValidatedDTO
{
    public $title_ru;
    public $title_kk;
    public $attempt_subject_id;
    public $questions;


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
