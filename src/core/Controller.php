<?php

namespace Core;

use Util\Logger;

abstract class Controller
{
    protected   $view;
    private     $viewPath;

    public function __construct()
    {
        $this->view = new \stdClass;
    }

    protected function loadView($path)
    {
        $this->viewPath = $path;
        $this->getViewFile();
    }

    protected function getViewFile()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Getting view file...");
        if (file_exists(__DIR__ . "/../app/Views/{$this->viewPath}.phtml")) {
            Logger::log_message(Logger::LOG_SUCCESS, "View found! " . __DIR__ . "/../app/Views/{$this->viewPath}.phtml");
            require_once __DIR__ . "/../app/Views/{$this->viewPath}.phtml";
        } else {
            Logger::log_message(Logger::LOG_ERROR, "View not found! " . __DIR__ . "/../app/Views/{$this->viewPath}.phtml");
            //TODO
            // View path not found
        }
    }
}