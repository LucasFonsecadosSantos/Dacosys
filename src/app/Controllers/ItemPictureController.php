<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ItemPictureModel;
use Core\Container;
use Util\Logger;

class ItemPictureController extends Controller 
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

    public function show()
    {
        //TODO ItemPictureController show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemPictureController, action show.");
    }

    public function upload()
    {
        //TODO ItemPictureController upload action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemPictureController, action upload.");
    }

    public function store()
    {
        //TODO ItemPictureController store action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemPictureController, action store.");
    }

    public function remove()
    {
        //TODO ItemPictureController show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemPictureController, action remove.");
    }

    public function delete()
    {
        //TODO ItemPictureController show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemPictureController, action delete.");
    }
}