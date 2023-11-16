<?php

namespace App\Http\Controllers\Api;

use App\DTOs\FindUserByEmailDTO;
use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use App\Services\RoleServices;
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
            ),200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


    public function userEmail(Request $request){
        try {
            $findUserByEmailDTO = FindUserByEmailDTO::fromRequest($request);
            $user = User::where(["email" => $findUserByEmailDTO->email,])->where("id","!=",auth()->guard('api')->id())->select([
                'id',
                "username",
                'name',
                'phone',
                'email',
                'image_url'
            ])->with("file")->first();
            if(!$user){
                return response()->json(new ResponseJSON(status: false,message: "Пользователь не найден"),400);
            }
            if(!$user->hasRole(RoleServices::STUDENT_ROLE_NAME)){
                return response()->json(new ResponseJSON(status: false,message: "Пользователь не найден"),400);
            }
            return response()->json(new ResponseJSON(
                status: true,
                data: $user
            ),200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
