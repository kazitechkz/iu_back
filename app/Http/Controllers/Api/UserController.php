<?php

namespace App\Http\Controllers\Api;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me()
    {
        try {
            $user = auth()->guard('api')->user()->load(['gender', 'file', 'roles']);
            $data = AuthService::initialUserDTO($user);
            return response()->json(new ResponseJSON(
                status: true,
                data: $data->data
            ));
        } catch (Exception $exception) {
            return response()->json(new ResponseJSON(status: false, errors: $exception->getMessage()), 500);
        }
    }
}
