<?php

namespace App\Services;

use App\DTOs\AuthDTO;
use App\DTOs\UserDTO;
use App\Models\User;

class AuthService
{
    public static function initialUserDTO(User $user): \WendellAdriel\ValidatedDTO\SimpleDTO
    {
        return UserDTO::fromArray([
            'id'=>$user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
            'file' => $user->file,
            'birth_date' => $user->birth_date,
            'phone' => $user->phone,
            'role' => $user->roles->count() ? $user->roles[0]['name'] : '',
            'subscription' => $user->activeSubscriptions()->toArray()
        ]);
    }

    public static function initialAuthDTO(User $user): \WendellAdriel\ValidatedDTO\SimpleDTO
    {
        $userDTO = self::initialUserDTO($user);
        return AuthDTO::fromArray([
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'role' => $user->roles->count() ? $user->roles[0]->name : 'student',
            'user' => $userDTO->data
        ]);
    }
}
