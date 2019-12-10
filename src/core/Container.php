<?php

namespace Core;

use Core\DataBase;

class Container 
{
    public static function getControllerInstance($controller)
    {
        $controller = "App\\Controllers\\" . $controller;
        return new $controller;
    }

    public static function getModelInstance($modelName, $connection = null)
    {
        $model = "App\\Models\\" . $modelName;
        if ($connection == null) {
            return new $model(DataBase::getInstance());
        } else {
            return new $model($connection);
        }
    }

    public static function Exception404()
    {
        if (file_exists(__DIR__ . "/../app/Views/exceptions/404.phtml")) {
            return require_once __DIR__ . "/../app/Views/exceptions/404.phtml";
        } else {
            echo "Error 4asd04.";
        }
    }
}