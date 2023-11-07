<?php

namespace App\Http\Controllers\Api;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me()
    {
        try {
            $user = auth()->guard('api')->user()->load(['gender', 'file', 'roles']);
            $data = UserDTO::fromArray([
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'gender' => $user->gender,
                'file' => $user->file,
                'birth_date' => $user->birth_date,
                'phone' => $user->phone,
                'role' => $user->roles->count() ? $user->roles[0]['name'] : '',
                'subscription' => $user->activeSubscriptions()->pluck('name')->toArray()
            ]);
            return response()->json(new ResponseJSON(
                status: true,
                data: $data->data
            ));
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }
}
