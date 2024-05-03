<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\UserRefcode;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function getMyReferrals()
    {
        try {
            $userID = auth()->guard('api')->id();
            $userRef = UserRefcode::firstWhere('user_id', $userID);
            $refs = Referral::with('referral')->where('referrer_id', $userID)->get();
            $data['code'] = $userRef->refcode;
            $data['referrals'] = $refs;
            return response()->json(new ResponseJSON(status: true, data: $data));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
