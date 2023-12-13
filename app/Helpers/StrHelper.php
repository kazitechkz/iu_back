<?php

namespace App\Helpers;

use App\Models\Question;
use Illuminate\Support\Str;

class StrHelper
{
    public static function getSubStr($str, $length = 50) : string
    {
//        $newStr = '';
//        if (preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $str, $match)) {
//
//            foreach ($match[0] as $item) {
//                $newStr = str_replace('<img src="' . $item . '" width="100%" height="100%">', ' ', $str);
//            }
//        } else {
//            $newStr = $str;
//        }
//        dd($newStr);
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

    public static function latexToHTML($str): array|string
    {
        $text = str_replace('<pre>', '$$', $str);
        return str_replace('</pre>', '$$', $text);
    }

    public static function convertLatex($str): array|string
    {
        $text = str_replace('<pre>', '$$', $str);
        return str_replace('</pre>', '@@', $text);
    }

    public static function getTitleAttribute(): string
    {
        return "title_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
    }
    public static function getTextAttribute(): string
    {
        return "text_".\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
    }

    public static function getFormattedTextForTranslateService($str): array|string
    {
        $text = str_replace('<предварительно>', '<pre>', $str);
        $scriptText = str_replace('</ предварительно>', '</pre>', $text);
        $preFinalText = str_replace('< ', '<', $scriptText);
        return str_replace('</ ', '</', str_replace(' >', '>', $preFinalText));
    }
}
