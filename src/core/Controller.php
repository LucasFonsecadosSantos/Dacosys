<?php

namespace Core;

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
        if (file_exists(__DIR__ . "/../app/Views/{$this->viewPath}.phtml")) {
            require_once __DIR__ . "/../app/Views/{$this->viewPath}.phtml";
        } else {
            //TODO
            // View path not found
        }
    }
}