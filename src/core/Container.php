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
        if (file_exists(__DIR__ . "/../app/Viwes/exceptions/404.phtml")) {
            return require_once __DIR__ . "/../app/Viwes/exceptions/404.phtml";
        } else {
            echo "Error 404.";
        }
    }
}