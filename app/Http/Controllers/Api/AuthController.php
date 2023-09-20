<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login The User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors()), 400);
            }
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(new ResponseJSON(status: false, message: "Email & Password does not match with our record."), 401);
            }
            $user = User::with('roles')->where('email', $request->email)->first();
            $data['token'] = $user->createToken("API TOKEN")->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            $data['role'] = $user->roles[0]['name'];
            return response()->json(new ResponseJSON(status: true, message: "User Logged In Successfully", data: $data));

        } catch (\Throwable $th) {
            return response()->json(new ResponseJSON(status: false, errors: $th->getMessage()), 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), (new UserCreateRequest())->rules());
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors()), 400);
            }
            $input = $request->all();
            $input["password"] = bcrypt($input["password"]);
            User::add($input);
            return response()->json(new ResponseJSON(status: true, message: "User registered successfully"), 200);
        } catch (\Throwable $th) {
            return response()->json(new ResponseJSON(status: false, message: $th->getMessage()), 500);
        }


    }
}
