<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ResearchModel;
use Core\Container;
use Util\Logger;

class ResearchController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher instantiated.");
        $this->view = new \stdClass;
    }

    public function register()
    {
        //TODO Researcher register action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action register.");
        // $this->loadView("home/index");
    }

    public function login()
    {
        //TODO Researcher login action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action login.");
        // $this->loadView("home/index");
    }

    public function listation()
    {
        //TODO Researcher listation action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action listation.");
        // $this->loadView("home/index");
    }

    public function store()
    {
        //TODO Researcher store action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action store.");
        // $this->loadView("home/index");
    }

    public function delete()
    {
        //TODO Researcher delete action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action delete.");
        // $this->loadView("home/index");
    }

    public function update()
    {
        //TODO Researcher update action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action update.");
        // $this->loadView("home/index");
    }

    public function show()
    {
        //TODO Researcher show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action show.");
        // $this->loadView("home/index");
    }
}