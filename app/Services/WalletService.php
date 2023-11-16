<?php

namespace App\Services;

use App\DTOs\TransactionDetailDTO;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WalletService
{

    public function getWithDrawAndStat($from,$to){
        $user = auth()->guard("api")->user();
        $result = [];
        //re-enable ONLY_FULL_GROUP_BY
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $data_transactions = $user
            ->walletTransactions()
            ->where("created_at",">=",$from)
            ->where("created_at","<=",$to)
            ->select("amount","type","uuid",DB::raw('DATE(created_at) as created'))
            ->get()
            ->groupBy(["created","type"])->toArray();
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        //disable ONLY_FULL_GROUP_BY
        foreach ($data_transactions as $date_time => $day_transactions){
            $result[$date_time] = [];
            foreach ($day_transactions as $type =>$transactions){
                $result[$date_time][$type] = ["amount"=>0];
                foreach ($transactions as $transaction){
                    $result[$date_time][$type]["amount"] += $transaction["amount"];
                }
            }
        }
        return $result;
    }

    public function getStatsByDate($from,$to){
        $user = auth()->guard("api")->user();
        $data_transactions = $user
            ->walletTransactions()
            ->where("created_at",">=",$from)
            ->where("created_at","<=",$to)
            ->orderBy("created_at","desc")
            ->with("wallet",function ($q){
                $q->select("id","holder_id","uuid","holder_type")
                    ->with("holder:id,email,username,name,phone");
            })
            ->with(["payable:id,email,username,name,phone"])
           ->get();
        return $data_transactions;
    }


}
