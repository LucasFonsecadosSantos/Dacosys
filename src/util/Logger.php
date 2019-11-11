<?php

namespace Util;

class Logger
{

    const LOG_INFORMATION   = "INFORMATION";
    const LOG_ERROR         = "ERROR";
    const LOG_SUCCESS       = "SUCCESS";
    const LOG_WARNING       = "WARNING";

    public static function log_message($title, $message)
    {
        error_log("[ LOG/" . $title ." ]: " . $message);
    }
}