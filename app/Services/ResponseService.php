<?php

namespace App\Services;

use App\Traits\ResponseJSON;
use Illuminate\Validation\ValidationException;

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
        return response()->json(new ResponseJSON(status: false,message: $exception->getMessage()),500);
    }

    public static function NotFound($message){
        return response()->json(new ResponseJSON(status: false,message: $message),404);
    }
}
