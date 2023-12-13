<?php

namespace App\Services;

use App\DTOs\BattleCreateDTO;
use App\DTOs\BattleStepCreateDTO;
use App\Models\Battle;
use App\Models\BattleStep;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BattleService
{
    public const STEPS = [1,2,3,4];
    public const OWNER_STEPS = [1,3];
    public const GUEST_STEPS = [2,4];
    public function createBattle(BattleCreateDTO $battleCreateDTO){
        $user = auth()->guard("api")->user();
        $input = $battleCreateDTO->toArray();
        $input["owner_id"] = $user->id;
        $input["promo_code"] = self::generatePromoCode("battle");
        $input["is_open"] = true;
        $input["start_at"] = Carbon::now();
        $input["must_finished"] = Carbon::now()->addDay();
        if($input["pass_code"]){
            $input["pass_code"] = bcrypt($input["pass_code"]);
        }
        $battle = Battle::add($input);
        foreach (self::STEPS as $STEP){
            $promo_code = self::generatePromoCode("battle_step");
            $input = [
                'promo_code'=>$promo_code,
                'battle_id'=>$battle->id,
                'subject_id'=>null,
                'current_user'=>null,
                'is_finished'=>false,
                'is_current'=>false,
                'is_last'=>false
            ];

        }

        return $battle;
    }

    public static function generatePromoCode($type){
        $battle_type = $type;
        $result = Str::random(10);
        if($type == "battle"){
            if(Battle::where(["promo_code" => $result])->first()){
                return self::generatePromoCode($battle_type);
            }
            return $result;
        }
        elseif ($type == "battle_step"){
            if(BattleStep::where(["promo_code" => $result])->first()){
                return self::generatePromoCode($battle_type);
            }
            return $result;
        }
    }


    public function createBattleStep(BattleStepCreateDTO $battleStepCreateDTO){
        $user = auth()->guard("api")->user();
        $input = $battleStepCreateDTO->toArray();

    }
}
