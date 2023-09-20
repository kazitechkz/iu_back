<?php

namespace App\Exceptions;

use App\Traits\ResponseJSON;
use Exception;
use function Laravel\Prompts\error;

class ApiValidationException extends Exception
{
    public function render($request)
    {
        return response()->json(new ResponseJSON(status: false,message: "Validation Error",data: null,errors: $request->validation() ), 400);
    }
}
