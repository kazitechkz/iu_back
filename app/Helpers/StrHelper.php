<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StrHelper
{
    public static function getSubStr($str, $length = 50) : string
    {
        if (strlen($str) < $length) {
            return Str::substr($str, 0, $length);
        } else {
            return Str::substr($str, 0, $length).'...';
        }
    }
}
