<?php

namespace App\Http\Controllers\Api;

use App\DTOs\MyTransactionDTO;
use App\DTOs\WalletTransferDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use App\Services\ResponseService;
use App\Services\RoleServices;
use App\Services\WalletService;
use App\Traits\ResponseJSON;
use Bavix\Wallet\Models\Transfer;
use Bavix\Wallet\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WalletController extends Controller
{
    private readonly WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index()
    {
        try {
            $user = auth()->guard("api")->user();
            $result = ["balance" => $user->balanceInt];
            $result["week_transaction_stats"] = $this->walletService->getWithDrawAndStat(Carbon::now()->addDays(-7), Carbon::now());
            $result["week_transaction"] = $this->walletService->getStatsByDate(Carbon::now()->addDays(-2), Carbon::now())->take(5);
            return response()->json(new ResponseJSON(
                status: true, data: $result
            ), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function getAllWalletRating()
    {
        try {
            $ratings = Wallet::with('holder')->orderBy('balance', 'DESC')->paginate(20);
            return response()->json(new ResponseJSON(
                status: true, data: $ratings
            ));
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function myBalance()
    {
        try {
            $user = auth()->guard("api")->user();
            return response()->json(new ResponseJSON(
                status: true, data: $user->balanceInt
            ), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function myWallet()
    {
        try {
            $user = auth()->guard("api")->user();
            $wallet = $user->wallet()->with("holder:id,email,username,name,phone")->first();
            return response()->json(new ResponseJSON(
                status: true, data: $wallet
            ), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public function myTransaction(Request $request)
    {
        try {
            $myTransactionDTO = MyTransactionDTO::fromRequest($request);
            $myTransactionDTO = $myTransactionDTO->toArray();
            $result = [];
            $from_date = Carbon::createFromFormat('d/m/Y', $myTransactionDTO["from_date"]);
            $to_date = Carbon::createFromFormat('d/m/Y', $myTransactionDTO["to_date"]);
            $result["date"] = "{$myTransactionDTO["from_date"]} - {$myTransactionDTO["to_date"]}";
            $result["week_transaction_stats"] = $this->walletService->getWithDrawAndStat($from_date, $to_date);
            $result["week_transaction"] = $this->walletService->getStatsByDate($from_date, $to_date);
            return response()->json(new ResponseJSON(
                status: true, data: $result
            ), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }

    public function transfer(Request $request)
    {
        try {
            $transferDTO = WalletTransferDTO::fromRequest($request);
            $user = auth()->guard("api")->user();
            $toUser = User::where(["id" => $transferDTO->toUserId])->first();
            if (!$toUser) {
                return response()->json(new ResponseJSON(status: false, message: "Пользователь не найден"), 400);
            }
            if (!$toUser->hasRole(RoleServices::STUDENT_ROLE_NAME)) {
                return response()->json(new ResponseJSON(status: false, message: "Пользователь не найден"), 400);
            }
            if ($user->balanceInt < $transferDTO->amount) {
                return response()->json(new ResponseJSON(status: false, message: "Средств недостаточно"), 400);
            }
            $user->transfer($toUser, $transferDTO->amount);
            return response()->json(new ResponseJSON(
                status: true, data: true
            ), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


}
