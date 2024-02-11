<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PayboxOrder;
use App\Services\PlanService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private PlanService $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    public function getAll()
    {
        try {
            $user = auth()->guard('api')->user();
            $orders = PayboxOrder::where('user_id', $user->id)->get();
            return response()->json(new ResponseJSON(
                status: true, data: $orders
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
