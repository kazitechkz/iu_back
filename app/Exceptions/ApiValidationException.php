<?php

namespace App\Exceptions;

use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\error;

class ApiValidationException extends Exception
{
    public function render($request)
    {
        if(gettype($this->getMessage())) {
            $request = json_decode($this->getMessage());
        }
        return response()->json(new ResponseJSON(status: false,message: "Validation Error",data: null,errors: $request), 400);
    }
}
