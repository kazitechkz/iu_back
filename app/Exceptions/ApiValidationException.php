<?php

namespace App\Exceptions;

use App\Traits\ResponseJSON;
use Exception;
use Illuminate\Validation\ValidationException;

class ApiValidationException extends ValidationException
{
    public function render($request)
    {
        return response()->json(new ResponseJSON(status: false,message: "Validation Error",data: null,errors: $this->validator->errors()->all()), 400);
    }

}
