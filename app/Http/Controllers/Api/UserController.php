<?php

namespace App\Http\Controllers\Api;

use App\DTOs\FindUserByEmailDTO;
use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use App\Services\RoleServices;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function changeProfile(Request $request)
    {
        try {
            $this->validate($request, [
                "name" => "required|max:255",
                "phone" => "required|max:255|unique:users,phone,".auth()->guard('api')->id(),
                "password" => "nullable|min:4|max:255"
            ]);
            $user = auth()->guard('api')->user();
            $user->name = $request['name'];
            $user->phone = $request['phone'];
            if ($request['password']) {
                $user->password = bcrypt($request['name']);
            }
            if ($request['date']) {
                $user->birth_date = Carbon::create($request['date']);
            }
            if ($request['gender']) {
                $user->gender_id = $request['gender'];
            }
            if ($request['parent_phone']) {
                $user->parent_phone = $request['parent_phone'];
            }
            if ($request['parent_name']) {
                $user->parent_name = $request['parent_name'];
            }
            $user->save();
            return response()->json(new ResponseJSON(
                status: true,
                data: true
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function changeAvatar(Request $request)
    {
        try {
            $this->validate($request, ['file' => 'required|image']);
            $user = auth()->guard('api')->user();
            if ($user->image_url) {
                File::deleteFileFromAWS($user->image_url);
            }
            $user->image_url = File::uploadFileAWS($request['file'], 'avatars');
            $user->save();
            return response()->json(new ResponseJSON(
                status: true,
                data: true
            ));
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
