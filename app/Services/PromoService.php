<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\TournamentException;
use App\Models\CareerCoupon;
use App\Models\CareerQuiz;
use App\Models\CareerQuizGroup;
use App\Models\PayboxOrder;
use App\Models\Promocode;
use App\Models\PromocodeUser;
use App\Models\SubTournament;
use App\Models\Tournament;
use App\Models\TournamentOrder;
use App\Models\User;
use App\Traits\ResponseJSON;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PromoService
{
    public static function getSum($time, $promoCode, $user): float
    {
        $promo = Promocode::where('code', $promoCode)->first();
        if ($promo && Carbon::create($promo->expired_at) > Carbon::now()) {
            if ($promo->plan_ids == null || in_array(1, $promo->plan_ids)) {
                if ($promo->group_ids == null || !empty(array_intersect($user->hubs()->pluck('hub_id')->toArray(), $promo->group_ids))) {
                    return match ($time) {
                        3 => round(3990 - (4990*($promo->percentage/100))),
                        6 => round(6990 - (8990*($promo->percentage/100))),
                        default => round(1590 - (1990*($promo->percentage/100))),
                    };
                } else {
                    throw new BadRequestException('К сожалению, вы не являетесь участником данного промокода!');
                }
            } else {
                throw new BadRequestException('Данный промокод не предназначен для оформления подписки!');
            }
        } else {
            throw new BadRequestException('Промокод не существует или просрочен!');
        }
    }
    public static function getCareerSum($price, $promoCode, $user): float
    {
        $promo = Promocode::where('code', $promoCode)->first();
        if ($promo && Carbon::create($promo->expired_at) > Carbon::now()) {
            if ($promo->plan_ids == null || in_array(1, $promo->plan_ids)) {
                if ($promo->group_ids == null || !empty(array_intersect($user->hubs()->pluck('hub_id')->toArray(), $promo->group_ids))) {
                    return round($price - ($price * ($promo->percentage/100)));
                } else {
                    throw new BadRequestException('К сожалению, вы не являетесь участником данного промокода!');
                }
            } else {
                throw new BadRequestException('Данный промокод не предназначен для оформления подписки!');
            }
        } else {
            throw new BadRequestException('Промокод не существует или просрочен!');
        }
    }
    public function check($code)
    {
        $promo = Promocode::where('code', $code)->first();
        $user = auth()->guard('api')->user();
        if ($promo && Carbon::create($promo->expired_at) > Carbon::now()) {
            if ($promo->plan_ids == null || in_array(1, $promo->plan_ids)) {
                if ($promo->group_ids == null || !empty(array_intersect($user->hubs()->pluck('hub_id')->toArray(), $promo->group_ids))) {
                    if (PromocodeUser::where(['user_id' => auth()->guard('api')->id(), 'promocode_id' => $promo->id])->first()) {
                        throw new BadRequestException('К сожалению, вы уже использовали этот промокод!');
                    } else {
                        return $promo->percentage;
                    }
                } else {
                    throw new BadRequestException('К сожалению, вы не являетесь участником данного промокода!');
                }
            } else {
                throw new BadRequestException('Данный промокод не предназначен для оформления подписки!');
            }
        } else {
            throw new BadRequestException('Промокод не существует или просрочен!');
        }
    }
}
