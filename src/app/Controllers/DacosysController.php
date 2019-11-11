<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\PersonModel;
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
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action index.");
        $this->loadView("home/index");
    }
}