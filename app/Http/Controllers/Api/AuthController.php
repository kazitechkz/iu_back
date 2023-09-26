<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Models\UserResetToken;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
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
            return response()->json(new ResponseJSON(status: true, message: "User Logged In Successfully", data: $user->createToken("API TOKEN")->plainTextToken));

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

    public function sendResetToken(Request $request){
        try {
            $validateUser = Validator::make($request->all(), ["email"=>"required|email|max:255"]);
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors(),data: false), 400);
            }
            $user = User::where(["email" => $request->get("email")])->first();
            if(!$user){
                return response()->json(new ResponseJSON(status: true, message: "User not found",data: false), 422);
            }
            UserResetToken::where(["user_id" => $user->id])->update(["is_used" => true]);
            $token = random_int(100000, 999999);
            UserResetToken::add(["user_id"=>$user->id,"email"=>$request->get("email"),"expired_at"=>Carbon::now()->addHour(2),"code"=>$token]);
            return response()->json(new ResponseJSON(status: true, message: "Token Sended to your account",data: true), 200);
        } catch (\Throwable $th) {
            return response()->json(new ResponseJSON(status: false, message: $th->getMessage(),data: false), 500);
        }
    }


    public function resetPassword(Request $request){
        try {
            $validateUser = Validator::make($request->all(), ["email"=>"required|email|max:255","password"=>"required|min:4|max:20","code"=>"required"]);
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors(),data: false), 400);
            }
            $reset_token = UserResetToken::where(["code" => $request->get("code"),"email" => $request->get("email"),"is_used" => false])->first();
            if(!$reset_token){
                return response()->json(new ResponseJSON(status: true, message: "Token is not valid or used",data: false), 422);
            }
            if($reset_token->expired_at < Carbon::now()){
                $reset_token->edit(["is_used"=>true]);
                return response()->json(new ResponseJSON(status: true, message: "Token is expired",data: false), 422);
            }
            $user = User::where(["email" => $request->get("email")])->first();
            if(!$user){
                return response()->json(new ResponseJSON(status: true, message: "User not found",data: false), 422);
            }
            $user->password = bcrypt($request->get("password"));
            $user->save();
            UserResetToken::where(["user_id" => $reset_token->user_id])->update(["is_used" => true]);
            return response()->json(new ResponseJSON(status: true, message: "Password successfully changed",data: true), 200);
        } catch (\Throwable $th) {
            return response()->json(new ResponseJSON(status: false, message: $th->getMessage(),data: false), 500);
        }
    }


}
