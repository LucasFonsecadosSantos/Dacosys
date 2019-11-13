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
        parent::__construct('ItemModel');
        $this->view = new \stdClass;
    }

    public function register()
    {
        //TODO ItemController register action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action register.");
        // $this->loadView("home/index");
    }

    public function listation()
    {
        //TODO ItemController key generation store method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action listation.");
        $itemArray = $this->model->getAll();
        print_r($itemArray);
    }

    public function store()
    {
        //TODO ItemController key generation store method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action store.");
    }

    public function show($id)
    {
        //TODO ItemController show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action show.");
        $item = $this->model->getByID($id);
        print_r($item);
    }

    public function answer()
    {
        //TODO ItemController answer action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action answer.");
    }

    public function edit()
    {
        //TODO ItemController edit action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action edit.");
    }

    public function update()
    {
        //TODO ItemController update action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action update.");
    }

    public function remove()
    {
        //TODO ItemController remove action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action remove.");
    }

    public function delete()
    {
        //TODO ItemController answer delete method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action delete.");
    }
}