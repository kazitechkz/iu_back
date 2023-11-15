<?php

namespace App\Http\Controllers\Api;

use App\DTOs\WalletTransferDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use App\Services\RoleServices;
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
            $result["week_transaction"] =  $this->walletService->getStatsByDate(Carbon::now()->addDays(-2),Carbon::now())->take(5);
            return response()->json(new ResponseJSON(
                status: true, data: $result
            ),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }

    public function myBalance(){
        try{
            $user = auth()->guard("api")->user();
            return response()->json(new ResponseJSON(
                status: true, data: $user->balanceInt
            ),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }

    public function transfer(Request $request){
        try{
            $transferDTO = WalletTransferDTO::fromRequest($request);
            $user = auth()->guard("api")->user();
            $toUser = User::where(["id"=>$transferDTO->toUserId])->first();
            if(!$toUser){
                return response()->json(new ResponseJSON(status: false,message: "Пользователь не найден"),400);
            }
            if(!$toUser->hasRole(RoleServices::STUDENT_ROLE_NAME)){
                return response()->json(new ResponseJSON(status: false,message: "Пользователь не найден"),400);
            }
            if($user->balanceInt < $transferDTO->amount){
                return response()->json(new ResponseJSON(status: false,message: "Средств недостаточно"),400);
            }
            $user->transfer($toUser,$transferDTO->amount);
            return response()->json(new ResponseJSON(
                status: true, data: true
            ),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
        }
    }
}
