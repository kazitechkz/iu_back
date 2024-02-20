<?php

namespace App\Http\Controllers\Api;

use App\DTOs\AuthDTO;
use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\Hub;
use App\Models\User;
use App\Models\UserHub;
use App\Models\UserResetToken;
use App\Services\AuthService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

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
            return $this->authService->login($request);
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
            return $this->authService->register($request);
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
            $this->authService->sendResetToken($request);
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
            $this->authService->resetPassword($request);
        } catch (\Throwable $th) {
            return response()->json(new ResponseJSON(status: false, message: $th->getMessage(),data: false), 500);
        }
    }

    public function userCheck(){
        try{
            return response()->json(new ResponseJSON(status: true, data: \auth()->guard("api")->check()), 200);
        }
        catch (Exception $exception){
            return response()->json(new ResponseJSON(status: true, data:false), 403);
        }
    }
}
