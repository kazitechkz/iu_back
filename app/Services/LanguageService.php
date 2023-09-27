<?php

namespace App\Services;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageService
{
    public static function getLocaleId(): int
    {
        $lang = LaravelLocalization::getCurrentLocale();
        if ($lang == 'kk') {
            return 1;
        } else {
            return 2;
        }
    }
}
