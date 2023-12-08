<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttemptSetting;
use App\Models\AttemptSettingsResult;
use App\Models\AttemptSettingsResultsUnt;
use App\Models\AttemptSettingsUnt;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class AttemptSettingsController extends Controller
{
    public function myAttemptSettingsSingle(Request $request){

        try {
            $user = auth()->guard("api")->user();
            $attemptSettingsIDS = AttemptSettingsResult::where(["user_id" => $user->id])->pluck("setting_id","setting_id")->toArray();
            $result = AttemptSetting::whereJsonContains("users",$user->id)->whereNotIn("id",$attemptSettingsIDS)->with(["locale","owner","subject.image"])->paginate(30);
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function myAttemptSettingsUNT(Request $request){
        try {
            $user = auth()->guard("api")->user();
            $attemptSettingsIDS = AttemptSettingsResultsUnt::where(["user_id" => $user->id])->pluck("setting_id","setting_id")->toArray();
            $result = AttemptSettingsUnt::whereJsonContains("users",$user->id)->whereNotIn("id",$attemptSettingsIDS)->with(["locale","sender"])->paginate(30);
            return response()->json(new ResponseJSON(status: true, data: $result), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
