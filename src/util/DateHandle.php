<?php

namespace Util;

class DateHandle
{
    public static function getDateTime()
    {
        return date("Y-m-d H:i:s");
    }

    public static function getWeekDay()
    {
        return date("l");
    }

    public static function getDay()
    {
        return date('d');
    }

    public static function getMonth()
    {
        return date('m');
    }

    public static function getYear()
    {
        return date('Y');
    }

    public static function getTime()
    {
        return date("H:i:s");
    }
}