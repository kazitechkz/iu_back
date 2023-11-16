<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Locale;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function index(){
        try{
            $locales = Locale::where(["isActive" => true])->get();
            return response()->json(new ResponseJSON(status: true,data: $locales),200);
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }
}
