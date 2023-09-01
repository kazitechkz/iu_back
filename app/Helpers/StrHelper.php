<?php

namespace App\Helpers;

use App\Models\Question;
use Illuminate\Support\Str;

class StrHelper
{
    public static function getSubStr($str, $length = 50) : string
    {
        $newStr = '';
        if (preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $str, $match)) {

            foreach ($match[0] as $item) {
                $newStr = str_replace('<img src="' . $item . '" width="100%" height="100%">', ' ', $str);
            }
        } else {
            $newStr = $str;
        }
        dd($newStr);
        if (strlen($newStr) < $length) {
            return Str::substr($newStr, 0, $length);
        } else {
            return Str::substr($newStr, 0, $length).'...';
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
