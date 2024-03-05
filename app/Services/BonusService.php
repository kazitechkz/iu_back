<?php

namespace App\Services;

use App\DTOs\AnswerBattleQuestion;
use App\DTOs\BattleCreateDTO;
use App\DTOs\BattleStepCreateDTO;
use App\Events\BattleAdded;
use App\Events\BattleDetailEvent;
use App\Events\BattleJoined;
use App\Events\WalletEvent;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Jobs\CompleteBattleGameJob;
use App\Models\Battle;
use App\Models\BattleBet;
use App\Models\BattleStep;
use App\Models\BattleStepQuestion;
use App\Models\BattleStepResult;
use App\Models\Question;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BonusService
{
    public static function everydayBonus(Request $request): void
    {
        if (auth()->check()) {
            $user = auth()->guard('api')->user();
            $userActivity = UserActivity::where('user_id', $user->id)->first();
            if ($userActivity) {
                $nowDate = Carbon::now();
                $lastBonusTime = Carbon::create($userActivity->last_bonus);
                $userActivity->last_login = Carbon::now();
                if ($nowDate->diffInDays($lastBonusTime) >= 1) {
                    $userActivity->last_bonus = Carbon::now();
                    $userActivity->ip = $request->ip();
                    $userActivity->save();
                    $user->deposit(100);
                    event(new WalletEvent($user->balanceInt));
                } else {
                    $userActivity->ip = $request->ip();
                    $userActivity->save();
                }
            } else {
                UserActivity::create([
                   'user_id' => $user->id,
                   'ip' => $request->ip(),
                    'last_login' => Carbon::now(),
                    'last_bonus' => Carbon::now()
                ]);
            }
        }
    }
}
