<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ItemModel;
use Core\Container;
use Util\Logger;

class ItemController extends Controller 
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