<?php

namespace App\Traits;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait Language
{
    public function getTitleAttribute()
    {
        return $this["title_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getNameAttribute()
    {
        return $this["name_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getPositionAttribute()
    {
        return $this["position_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getFileAttribute()
    {
        return $this["file_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getSourceAttribute()
    {
        return $this["source_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this["description_" . LaravelLocalization::getCurrentLocale()];
    }

    public function getButtonAttribute()
    {
        return $this["button_" . LaravelLocalization::getCurrentLocale()];
    }
}
