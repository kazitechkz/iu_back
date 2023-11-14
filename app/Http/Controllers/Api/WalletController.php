<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WalletService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    private readonly WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index(){
        try{
            $user = auth()->guard("api")->user();
            $result = ["balance"=>$user->balanceInt];
            $result["week_transaction_stats"] =  $this->walletService->getWithDrawAndStat(Carbon::now()->addDays(-7),Carbon::now());
            $result["week_transaction"] =  $this->walletService->getStatsByDate(Carbon::now()->addDays(-2),Carbon::now());
            return response()->json(new ResponseJSON(
                status: true, data: $result
            ),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }
}
