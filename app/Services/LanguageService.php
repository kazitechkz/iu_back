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

    public static function getTitleByLocale($id): string
    {
        if ($id == 1) {
            return 'title_kk';
        } else {
            return 'title_ru';
        }
    }
}
