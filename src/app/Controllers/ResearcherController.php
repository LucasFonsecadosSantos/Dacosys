<?php

namespace App\Controllers;

use Core\Controller;
use Core\Container;
use Util\Logger;

class ResearcherController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher instantiated.");
        parent::__construct('ResearcherModel');
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
        $researcherArray = $this->model->getAll('_RESEARCHER_');
        print_r($researcherArray);
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

    public function show($id)
    {
        //TODO Researcher show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action show.");
        $researcher = $this->model->getByID($id, '_RESEARCHER_');
        print_r($researcher);
    }
}