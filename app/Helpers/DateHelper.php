<?php

namespace App\Helpers;

class DateHelper
{
    const DATETIME_API_FORMAT = 'Y-m-d H:i:s';

    /**
     * @return string
     */
    public static function apiDateFormat(): string
    {
        return sprintf('date_format:%s', self::DATETIME_API_FORMAT);
    }
}
