<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Battle;
use App\Models\Information;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public  function  getMainNews()
    {
        try {
            $main_information = Information::where("published_at","<=",Carbon::now())->where(["is_active" => true,"is_main" => true])
                ->with(["information_author","information_category","file"])
                ->orderBy("published_at","DESC")
                ->first();
            if($main_information != null){
                $other_information = Information::where("published_at","<=",Carbon::now())
                    ->where("id","!=",$main_information->id)->where(["is_active" => true,"is_main" => true])
                    ->with(["information_author","information_category","file"])
                    ->orderBy("published_at","DESC")
                    ->get();
            }
            else{
                $other_information = [];
            }
            $results = ["main_information"=>$main_information,"other_information"=>$other_information];
            return response()->json(new ResponseJSON(status: true, data: $results), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

    public  function  getInformations(){
        try {
            $informations = Information::where("published_at","<=",Carbon::now())
                ->where(["is_main" => false,"is_active" => true])
                ->with(["information_author","information_category","file"])->paginate(18);
            return response()->json(new ResponseJSON(status: true, data: $informations), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }

}
