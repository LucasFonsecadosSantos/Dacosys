<?php

namespace Core;

use Util\Logger;

abstract class Controller
{
    protected   $model;
    protected   $view;
    protected   $auth;
    protected   $success;
    protected   $error;
    protected   $information;
    protected   $navigationRoute;
    private     $viewPath;

    public function __construct($modelName = null)
    {
        $this->view = new \stdClass;
        $this->view->navigationRoute = [];
        $this->auth = new Auth;
        // if ($modelName != null) {
        //     $this->model = Container::getModelInstance($modelName);
        // }
        $this->checkMessages();
    }

    private function checkMessages()
    {
        if (Session::get('success')) {
            $this->success = Session::get('success');
            Session::destroy('success');
        }

        if (Session::get('error')) {
            $this->error = Session::get('error');
            Session::destroy('error');
        }

        if (Session::get('information')) {
            $this->information = Session::get('information');
            Session::destroy('information');
        }
    }

    protected function loadView($path)
    {
        $this->viewPath = $path;
        return $this->getViewFile();
    }

    protected function getViewFile()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Getting view file...");
        if (file_exists(__DIR__ . "/../app/Views/{$this->viewPath}.phtml")) {
            Logger::log_message(Logger::LOG_SUCCESS, "View found! " . __DIR__ . "/../app/Views/{$this->viewPath}.phtml");
            return require_once __DIR__ . "/../app/Views/{$this->viewPath}.phtml";
        } else {
            Logger::log_message(Logger::LOG_ERROR, "View not found! " . __DIR__ . "/../app/Views/{$this->viewPath}.phtml");
            //TODO
            // View path not found
        }
    }

    public function forbiden()
    {
        return Redirect::route('/login');
    }
}