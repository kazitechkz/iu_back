<?php

namespace App\Exceptions;

use App\Traits\ResponseJSON;
use Exception;

class NotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json(new ResponseJSON(status: false,message: $this->getMessage()), 404);
    }
}
