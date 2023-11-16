<?php

namespace App\DTOs;

use App\Exceptions\ApiValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UserDTO extends ValidatedDTO
{
    public string $username;
    public string $name;
    public string $email;
    public string $phone;
    public int $id;
    public string $role;
    public array|null $subscriptions;
    public $birth_date;
    public $gender;
    public $file;
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
    protected function failedValidation(): void
    {
        throw new ApiValidationException($this->validator);
    }
}
