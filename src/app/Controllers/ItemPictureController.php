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

    public function listation()
    {
        $model = Container::getModelInstance('ItemPictureModel');
        $itemPictureArray = $model->getAll();
        print_r($itemPictureArray);
    }

    public function show($id)
    {
        //TODO ItemPictureController show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemPictureController, action show.");
        $model = Container::getModelInstance('ItemPictureModel');
        $itemPicture = $model->getByID($id);
        print_r($itemPicture);
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