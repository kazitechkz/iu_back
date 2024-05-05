<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CashService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class CashController extends Controller
{
    private CashService $cashService;

    /**
     * @param CashService $cashService
     */
    public function __construct(CashService $cashService)
    {
        $this->cashService = $cashService;
    }

    public function getHistories()
    {
        try {
          $histories = $this->cashService->getHistories();
          return response()->json(new ResponseJSON(status: true, data: $histories));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
    public function requestWithdraw(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();
            $this->validate($request, ['phone' => 'required|unique:users,phone,'.$user->id]);
            $this->cashService->requestWithdraw($request,$user);
            return response()->json(new ResponseJSON(status: true, data: true));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
