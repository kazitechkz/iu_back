<?php

namespace App\Traits;

class ResponseJSON
{
    public bool $status;
    public $message;
    public $errors;
    public $data;

    public function __construct($status, $message = null, $errors = null, $data = null)
    {
        $this->status = $status;
        $this->message = $message;
        $this->errors = $errors;
        $this->data = $data;
    }
}
