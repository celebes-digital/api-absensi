<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatDate($format, $date)
    {
        Carbon::setLocale('id');
        return $date->translatedFormat($format);
    }
}