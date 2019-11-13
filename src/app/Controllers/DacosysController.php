<?php

namespace App\Controllers;

use Core\Controller;
use Core\Container;
use Util\Logger;

class DacosysController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        $this->view = new \stdClass;
    }

    public function index()
    {
        //TODO DacosysController index action method.
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action index.");
        $this->loadView("home/index");
    }

    public function keyGeneration()
    {
        //TODO DacosysController key generation action method.
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action key generation.");
    }

    public function bugReport()
    {
        //TODO DacosysController bug report action method.
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action bug report.");
    }

    public function about()
    {
        //TODO DacosysController about action method.
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action about.");
    }
}