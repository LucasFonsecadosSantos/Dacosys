<?php

if (!session_id()) {
    session_start();
}

$routes = require_once __DIR__ . "/../app/routes.php";

$route = new \Core\Route($routes);