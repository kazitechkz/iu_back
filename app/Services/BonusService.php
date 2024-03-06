<?php

namespace App\Services;

use App\Events\WalletEvent;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
