<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ForumCreateDTO extends ValidatedDTO
{

    public string $text;
    public string $attachment;
    public string $subject_id;
    public $files = [];
    protected function rules(): array
    {
        return [
            "text"=>"required|max:255",
            "attachment"=>"required|max:5000",
            "subject_id"=>"required|exists:subjects,id",
            "files"=>"sometimes|nullable",
            "files.*"=>"nullable|sometimes|image|max:5000",
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
