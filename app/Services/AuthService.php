<?php

namespace App\Services;

use App\DTOs\AuthDTO;
use App\DTOs\UserDTO;
use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\UserHub;
use App\Models\UserResetToken;
use App\Traits\ResponseJSON;
use Bavix\Wallet\Internal\Exceptions\ExceptionInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class AuthService
{
    public static function initialUserDTO(User $user): \WendellAdriel\ValidatedDTO\SimpleDTO
    {
        return UserDTO::fromArray([
            'id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
            'file' => $user->file,
            'birth_date' => $user->birth_date,
            'phone' => $user->phone,
            'balance' => $user->balanceInt,
            'role' => $user->roles->count() ? $user->roles[0]['name'] : '',
            'subscription' => $user->activeSubscriptions()->toArray()
        ]);
    }

    public static function initialAuthDTO(User $user, bool $isVerify = false): \WendellAdriel\ValidatedDTO\SimpleDTO
    {
        if ($isVerify) {
            $userDTO = self::initialUserDTO($user);
            return AuthDTO::fromArray([
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'role' => $user->roles->count() ? $user->roles[0]->name : 'student',
                'user' => $userDTO->data,
                'redirectURL' => ''
            ]);
        } else {
            $redirectURL = "https://iutest.kz/auth/verify-email?user=".Crypt::encrypt($user->id);
            return AuthDTO::fromArray([
                'token' => '',
                'role' => '',
                'user' => '',
                'redirectURL' => $redirectURL
            ]);
        }
    }
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(new ResponseJSON(status: false, message: "Email & Password does not match with our record."), 400);
        }
        $user = User::with('roles')->where('email', $request->email)->first();
        if ($user->email_verified_at == null) {
            $data = AuthService::initialAuthDTO($user);
        } else {
            $data = AuthService::initialAuthDTO($user, true);
        }
        return response()->json(new ResponseJSON(status: true, message: "User Logged In Successfully", data: $data->data));
    }

    /**
     * @throws ExceptionInterface
     * @throws Exception
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $input["email"] = strtolower($input["email"]);
        $input['username'] = $input['email'];
        if ($input['role'] == 'teacher') {
            $input['role'] = 'teacher';
        } else {
            $input['role'] = 'student';
        }
        $data = ['code' => random_int(1000, 9999)];
//        $input['email_code'] = $data['code'];
        $input['email_code'] = 1111;
        $user = User::add($input);
//        MailService::sendMail('mails.verify-email', $data, $input['email'], 'Подтверждение электронной почты');
        UserHub::create([
            'user_id' => $user->id,
            'hub_id' => 2
        ]);
        $user->deposit(1000);
        $role = Role::findByName($input['role']);
        if ($role) {
            $user->assignRole($input['role']);
        }
        $redirectURL = "https://iutest.kz/auth/verify-email?user=".Crypt::encrypt($user->id);
        return response()->json(new ResponseJSON(status: true, message: "User registered successfully", data: $redirectURL));
    }
    public function verifyEmail(Request $request): bool
    {
        $userID = Crypt::decrypt($request['user_id']);
        $user = User::find($userID);
        if ($user->email_code == $request['code']) {
            $user->email_verified_at = Carbon::now();
            $user->save();
            return true;
        } else {
            return false;
        }
    }
    public function sendResetToken(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where(["email" => $request->get("email")])->first();
        if(!$user){
            return response()->json(new ResponseJSON(status: true, message: "User not found",data: false), 422);
        }
        UserResetToken::where(["user_id" => $user->id])->update(["is_used" => true]);
        $token = random_int(100000, 999999);
        UserResetToken::add(["user_id"=>$user->id,"email"=>$request->get("email"),"expired_at"=>Carbon::now()->addHour(2),"code"=>$token]);
        return response()->json(new ResponseJSON(status: true, message: "Token Sended to your account",data: true), 200);
    }
    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $reset_token = UserResetToken::where(["code" => $request->get("code"), "email" => $request->get("email"), "is_used" => false])->first();
        if (!$reset_token) {
            return response()->json(new ResponseJSON(status: true, message: "Token is not valid or used", data: false), 422);
        }
        if ($reset_token->expired_at < Carbon::now()) {
            $reset_token->edit(["is_used" => true]);
            return response()->json(new ResponseJSON(status: true, message: "Token is expired", data: false), 422);
        }
        $user = User::where(["email" => $request->get("email")])->first();
        if (!$user) {
            return response()->json(new ResponseJSON(status: true, message: "User not found", data: false), 422);
        }
        $user->password = bcrypt($request->get("password"));
        $user->save();
        UserResetToken::where(["user_id" => $reset_token->user_id])->update(["is_used" => true]);
        return response()->json(new ResponseJSON(status: true, message: "Password successfully changed", data: true), 200);
    }
}
