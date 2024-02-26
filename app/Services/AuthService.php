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
            'subscription' => $user->activeSubscriptions()->toArray(),
            'isKundelik' => $user->isKundelik()
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
            $redirectURL = "https://iutest.kz/auth/verify-email?user=" . Crypt::encrypt($user->id);
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
            return response()->json(new ResponseJSON(status: false, message: "Адрес электронной почты и пароль не совпадают с нашей записью."), 400);
        }
        $user = User::with('roles')->where('email', $request->email)->first();
        if ($user->email_verified_at == null) {
            $tokenCode = random_int(1000, 9999);
            $user->email_code = $tokenCode;
            $user->save();
            $data = ['code' => $tokenCode];
            MailService::sendMail('mails.verify-email', $data, $request['email'], 'Подтверждение электронной почты');
            $data = AuthService::initialAuthDTO($user);
        } else {
            $data = AuthService::initialAuthDTO($user, true);
        }
        return response()->json(new ResponseJSON(status: true, message: "Вы успешно авторизовались", data: $data->data));
    }

    public function registerUserFromKundelik($request)
    {
        $email = $request['id'] ? $request['id'] . '@kundelik.kz' : '';
        $user = User::where('email', $email)->first();
        if (!$user) {
            if ($request['roles'][0] == 'EduStudent') {
                $user = $this->getInitialDataForKundelik($request, $email);
                $user->deposit(1000);
                $user->assignRole('student');
            } else {
                $user = $this->getInitialDataForKundelik($request, $email);
                $user->assignRole('teacher');
            }
        }
        $data = AuthService::initialAuthDTO($user, true);
        return response()->json(new ResponseJSON(status: true, message: "Вы успешно авторизовались", data: $data->data));
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
        $input['email_code'] = $data['code'];
//        $input['email_code'] = 1111;
        $user = User::add($input);
        MailService::sendMail('mails.verify-email', $data, $input['email'], 'Подтверждение электронной почты');
        UserHub::create([
            'user_id' => $user->id,
            'hub_id' => 2
        ]);
        if ($input['role'] == 'student') {
            $user->deposit(1000);
        }
        if (Role::findByName($input['role'])) {
            $user->assignRole($input['role']);
        }
        $redirectURL = "https://iutest.kz/auth/verify-email?user=" . Crypt::encrypt($user->id);
        return response()->json(new ResponseJSON(status: true, message: "Вы успешно зарегистрированы", data: $redirectURL));
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
        if (!$user) {
            return response()->json(new ResponseJSON(status: false, message: "Пользователь не найден", data: false), 422);
        }
        $token = random_int(100000, 999999);
        $data = ['data' => ['name' => $user->name, 'code' => $token]];
        MailService::sendMail('mails.reset-password', $data, $request['email'], 'Восстановление пароля');
        $userToken = UserResetToken::where(["user_id" => $user->id])->first();
        if ($userToken) {
            $userToken->is_used = false;
            $userToken->code = $token;
            $userToken->expired_at = Carbon::now()->addHour()->setTimezone('Asia/Almaty');
            $userToken->save();
        } else {
            UserResetToken::add(["user_id" => $user->id, "email" => $request->get("email"), "expired_at" => Carbon::now()->addHour()->setTimezone('Asia/Almaty'), "code" => $token]);
        }
        return response()->json(new ResponseJSON(status: true, message: "Код успешно отправлен на ваш электронный адрес", data: true));
    }

    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $reset_token = UserResetToken::where(["code" => $request->get("code"), "email" => $request->get("email"), "is_used" => false])->first();
        if (!$reset_token) {
            return response()->json(new ResponseJSON(status: true, message: "Не валидный токен", data: false), 422);
        }
        if ($reset_token->expired_at < Carbon::now()) {
            $reset_token->edit(["is_used" => true]);
            return response()->json(new ResponseJSON(status: true, message: "Устаревший токен", data: false), 422);
        }
        $user = User::where(["email" => $request->get("email")])->first();
        if (!$user) {
            return response()->json(new ResponseJSON(status: true, message: "User not found", data: false), 422);
        }
        $user->password = bcrypt($request->get("password"));
        $user->save();
        UserResetToken::where(["user_id" => $reset_token->user_id])->update(["is_used" => true]);
        return response()->json(new ResponseJSON(status: true, message: "Пароль успешно изменен", data: true), 200);
    }

    /**
     * @param $request
     * @param string $email
     * @return User
     */
    public function getInitialDataForKundelik($request, string $email): User
    {
        $userData['name'] = $request['shortName'] ? $request['shortName'] : '-';
        $userData['birth_date'] = $request['birthday'] ? Carbon::create($request['birthday']) : '';
        $userData['email'] = $email;
        $userData['phone'] = $request['phone'] ? $request['phone'] : '';
        $userData['gender_id'] = $request['sex'] == 'Male' ? 1 : 2;
        $userData['username'] = $request['login'] ? $request['login'] : '';
        $userData['email_verified_at'] = Carbon::now();
        $userData['password'] = bcrypt('kundelik123');
        $user = User::add($userData);
        UserHub::create([
            'user_id' => $user->id,
            'hub_id' => 1
        ]);
        return $user;
    }
}
