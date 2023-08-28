<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseJSON;
use Bpuig\Subby\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(){
        try {
            $plans = Plan::all();
            return response()->json(new ResponseJSON(status: true,data: $plans),500);

        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }
}
