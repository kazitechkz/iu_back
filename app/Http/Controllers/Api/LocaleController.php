<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Locale;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function index(){
        try{
            $locales = Locale::where(["isActive" => true])->get();
            return response()->json(new ResponseJSON(status: true,data: $locales),200);
        }
        catch (\Exception $ex){
            return response()->json(new ResponseJSON(status: false,message: $ex->getMessage()),500);
        }

    }
}
