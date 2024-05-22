<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\TournamentException;
use App\Models\CareerCoupon;
use App\Models\CareerQuiz;
use App\Models\CareerQuizGroup;
use App\Models\Cash;
use App\Models\PayboxOrder;
use App\Models\Promocode;
use App\Models\PromocodeUser;
use App\Models\Referral;
use App\Models\SubTournament;
use App\Models\Tournament;
use App\Models\TournamentOrder;
use App\Models\User;
use App\Models\UserRefcode;
use App\Traits\ResponseJSON;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PromoService
{
    /**
     * @throws BadRequestException
     */
    public static function getSum($time, $promoCode, $user): float
    {
        if (UserRefcode::firstWhere('refcode', $promoCode)) {
            if (Referral::firstWhere('referee_id', auth()->guard('api')->id())) {
                throw new BadRequestException('К сожалению, вы уже воспользовались реферальным промокодом!');
            }
            return match ($time) {
                3 => round(3990 - (3990*(20/100))),
                6 => round(6990 - (6990*(20/100))),
                default => round(1590 - (1590*(20/100))),
            };
        } else {
            $promo = Promocode::where('code', $promoCode)->first();
            if ($promo && Carbon::create($promo->expired_at) > Carbon::now()) {
                if ($promo->plan_ids == null || in_array(1, $promo->plan_ids)) {
                    if ($promo->group_ids == null || !empty(array_intersect($user->hubs()->pluck('hub_id')->toArray(), $promo->group_ids))) {
                        return match ($time) {
                            3 => round(3990 - (3990*($promo->percentage/100))),
                            6 => round(6990 - (6990*($promo->percentage/100))),
                            default => round(1590 - (1590*($promo->percentage/100))),
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

    }
    public static function getCareerSum($price, $promoCode, $user): float
    {
        $promo = Promocode::where('code', $promoCode)->first();
        if ($promo && Carbon::create($promo->expired_at) > Carbon::now()) {
            if ($promo->plan_ids == null || in_array(2, $promo->plan_ids)) {
                if ($promo->group_ids == null || !empty(array_intersect($user->hubs()->pluck('hub_id')->toArray(), $promo->group_ids))) {
                    return round($price - ($price * ($promo->percentage/100)));
                } else {
                    throw new BadRequestException('К сожалению, вы не являетесь участником данного промокода!');
                }
            } else {
                throw new BadRequestException('Данный промокод не предназначен для оформления профориентационного теста!');
            }
        } else {
            throw new BadRequestException('Промокод не существует или просрочен!');
        }
    }

    /**
     * @throws BadRequestException
     */
    public function check($code, $type)
    {
        if (UserRefcode::firstWhere('refcode', $code)) {
            if (Referral::firstWhere('referee_id', auth()->guard('api')->id())) {
                throw new BadRequestException('К сожалению, вы уже воспользовались реферальным промокодом!');
            }
            return 20;
        } else {
            $promo = Promocode::where('code', $code)->first();
            $user = auth()->guard('api')->user();
            if ($promo && Carbon::create($promo->expired_at) > Carbon::now()) {
                if ($promo->plan_ids == null || in_array($type, $promo->plan_ids)) {
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
                    if ($type == 1) {
                        throw new BadRequestException('Данный промокод не предназначен для оформления подписки!');
                    } else {
                        throw new BadRequestException('Данный промокод не предназначен для оформления профориентационного теста!');
                    }
                }
            } else {
                throw new BadRequestException('Промокод не существует или просрочен!');
            }
        }
    }

    public static function setBonusForRef($user, $price, $refCode = null): void
    {
        $mod = new self();
        $check = false;
        if ($refCode) {
            $referrer = UserRefcode::firstWhere('refcode', $refCode);
            if ($referrer) {
                $refUser = Referral::firstWhere('referee_id', $user->id);
                if ($refUser) {
                    if ($refUser->referrer_id == $referrer->user_id) {
                        $mod->cashBalance($referrer->user_id, $price);
                        $check = true;
                    }
                } else {
                    $ref = Referral::create(['referrer_id' => $referrer->user_id, 'referee_id' => $user->id]);
                    $mod->cashBalance($ref->referrer_id, $price);
                    $check = true;
                }
            }
        }
        if (!$check) {
            $refUser = Referral::firstWhere('referee_id', $user->id);
            if ($refUser) {
                $mod->cashBalance($refUser->referrer_id, $price);
            }
        }
    }

    protected function cashBalance($userID, $price): void
    {
        $cashUser = Cash::firstWhere('user_id', $userID);
        if ($cashUser) {
            $cashUser->balance += round($price*0.2);
            $cashUser->save();
        } else {
            Cash::create(['user_id' => $userID, 'balance' => round($price*0.2)]);
        }
    }
}
