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
            $user = auth()->user();
            $data = UserDTO::fromArray([
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'id' => $user->id,
                'role' => $user->roles[0]['name'],
                'subscription' => $user->activeSubscriptions()->pluck('name')->toArray()
            ]);
            return response()->json(new ResponseJSON(
                status: true,
                data: $data->data
            ));
        } catch (Exception $ex) {

        }
    }



}
