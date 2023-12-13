<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class BattleController extends Controller
{
    public function createBattle(Request $request){
        try {

            return response()->json(new ResponseJSON(status: true, data: true), 200);
        } catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }


}
