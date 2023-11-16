<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppealType;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class AppealTypeController extends Controller
{
    public function index(){
        try {
            $appeal_types = AppealType::where(["isActive" => true])->get();
            return response()->json(new ResponseJSON(status: true,data: $appeal_types),200);

        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
