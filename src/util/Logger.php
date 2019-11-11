<?php

namespace Util;

class Logger
{
    public static function log_message($title, $message)
    {
        error_log("[ LOG/" . $title ." ]: " . $message);
    }
}