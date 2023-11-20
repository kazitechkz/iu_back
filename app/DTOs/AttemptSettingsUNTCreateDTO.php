<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttemptSettingsUNTCreateDTO extends ValidatedDTO
{
    public $promo_code;
    public $locale_id;
    public $sender_id;
    public $class_id;
    public $users;
    public $subjects;
    public $settings;
    public $time;
    public $hidden_fields;




    protected function rules(): array
    {
        return [
            'settings' => '',
            'locale_id' => 'required|exists:locales,id',
            'sender_id' => 'required|exists:users,id',
            'class_id' => 'sometimes|nullable|exists:classroom_groups,id',
            'subjects' => 'required|array|between:1,3',
            'subjects.*' => 'required|exists:subjects,id',
            'time' => 'required|integer|max:500|min:1',
            'hidden_fields' => 'sometimes|nullable|max:255',
            'users' => 'sometimes|nullable|array',
            "users.*"=>"exists:users,id",
            'promo_code' => '',
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
