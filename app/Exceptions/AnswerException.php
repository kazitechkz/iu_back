<?php

namespace App\Exceptions;

use App\Traits\ResponseJSON;
use Exception;

class AnswerException extends Exception
{
    public function render($request)
    {
        return response()->json(new ResponseJSON(status: false,message: $this->getMessage()), 401);
    }
}