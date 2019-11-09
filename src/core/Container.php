<?php

namespace Core;

class Container 
{
    public static function getControllerInstance($controller)
    {
        $controller = "App\\Controllers\\" . $controller;
        return new $controller;
    }

    public static function Exception404()
    {
        echo "404";
    }
}