<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ParticipantModel;
use Core\Container;
use Util\Logger;

class ParticipantController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        $this->view = new \stdClass;
    }

    public function register()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action index.");
        // $this->loadView("home/index");
    }
}