<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        try {
            $faqs = Faq::where(["is_active" => true])->get();
            return response()->json(new ResponseJSON(status: true, data: $faqs),200);
        }
        catch (\Exception $exception){
            return response()->json(new ResponseJSON(status: false, message: $exception->getMessage()),500);
        }
    }
}
