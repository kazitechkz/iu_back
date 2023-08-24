<?php

namespace App\Helpers;

use App\Models\Question;
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

    public static function getCorrectAnswers(Question $question, string $var): string
    {
        if ($var) {
            return $question['answer_'.$var];
        } else {
            return '';
        }
    }
}
