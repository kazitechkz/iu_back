<?php

namespace App\Services;

use App\Traits\ResponseJSON;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\error;

class ResponseService
{
    public static function DefineException(\Exception $exception){
        // If validation fails, return JSON response with validation errors
        if($exception instanceof  ValidationException){
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $exception->errors(),
            ], 400);
        }
        //Log::channel('telegram')->error($exception);
        return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
    }

    public static function NotFound($message){
        return response()->json(new ResponseJSON(status: false,message: $message),404);
    }

    public static function NotAllowed($content = false, $unt = false){
        if($content){
            response()->json(new ResponseJSON(status: false,message: "content"),403);
        }
        elseif ($unt){
            response()->json(new ResponseJSON(status: false,message: "unt"),403);
        }
        return response()->json(new ResponseJSON(status: false,message: "Not Allowed"),403);
    }
}
