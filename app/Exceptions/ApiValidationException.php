<?php

namespace App\Exceptions;

use App\Traits\ResponseJSON;
use Exception;

class ApiValidationException extends Exception
{
    public function render($request)
    {
        return response()->json(new ResponseJSON(status: false,message: "Validation Error",data:json_decode($this->getMessage()) ), 401);
    }
}
