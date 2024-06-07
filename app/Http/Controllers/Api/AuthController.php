<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Services\AuthService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function loginUserFromKundelik(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'token' => 'required'
                ]);
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors()), 400);
            }
            $user = Http::connectTimeout(120)
                ->timeout(120)
                ->withoutVerifying()
                ->withHeader('Access-token', $request['token'])
                ->get('https://api.kundelik.kz/v2/users/me');

            if ($user->failed()) {
                return response()->json(['error' => 'Failed to connect to Kundelik API'], 500);
            }

            $body = json_decode($user->body(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['error' => 'Failed to decode JSON response'], 500);
            }

            return $this->authService->registerUserFromKundelik($body);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function loginWithGoogle(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email' => 'required'
                ]);
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors()), 400);
            }
            return $this->authService->registerFromGoogle($request);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
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
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function verifyEmail(Request $request)
    {
        try {
            $this->validate($request, ['user_id' => 'required', 'code' => 'required']);
            if ($this->authService->verifyEmail($request)) {
                return response()->json(new ResponseJSON(status: true, data: true));
            } else {
                return response()->json(new ResponseJSON(status: false, message: 'Не валидный код', data: false), 500);
            }
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function sendResetToken(Request $request){
        try {
            $validateUser = Validator::make($request->all(), ["email"=>"required|email|max:255"]);
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors(),data: false), 400);
            }
            return $this->authService->sendResetToken($request);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function resetPassword(Request $request){
        try {
            $validateUser = Validator::make($request->all(), ["email"=>"required|email|max:255","password"=>"required|min:4|max:20","code"=>"required"]);
            if ($validateUser->fails()) {
                return response()->json(new ResponseJSON(status: false, message: "Validation Error", errors: $validateUser->errors(),data: false), 400);
            }
            return $this->authService->resetPassword($request);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function userCheck(){
        try{
            return response()->json(new ResponseJSON(status: true, data: \auth()->guard("api")->check()), 200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function logOut() {
        auth()->guard('api')->user()->tokens()->delete();
    }
}
