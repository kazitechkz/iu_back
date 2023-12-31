<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AttemptSettingsCreateDTO extends ValidatedDTO
{
    public $settings;
    public $locale_id;
    public $subject_id;
    public $time;
    public $hidden_fields;
    public $users;
    public $point;
    public $promo_code;
    public $owner_id;
    public $class_id;

    protected function rules(): array
    {
        return [
            'settings' => 'required',
            'locale_id' => 'required|exists:locales,id',
            'owner_id' => 'required|exists:users,id',
            'class_id' => 'sometimes|nullable|exists:classroom_groups,id',
            'subject_id' => 'required|exists:subjects,id',
            'time' => 'required|integer|max:300|min:1',
            'hidden_fields' => 'sometimes|nullable|max:255',
            'users' => 'sometimes|nullable|array',
            "users.*"=>"exists:users,id",
            'promo_code' => '',
            'point' => '',
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
