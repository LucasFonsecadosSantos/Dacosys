<?php

namespace App\Controllers;

use Core\Controller;
use Core\Container;
use Core\DataBase;
use Util\Logger;

class DacosysController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        parent::__construct('PersonModel');
        $connection = DataBase::getInstance();
        $this->personModel  = Container::getModelInstance('ResearcherModel', $connection);
        $this->quizModel    = Container::getModelInstance('QuizModel', $connection);
        $this->view = new \stdClass;
    }

    public function index()
    {
        //TODO DacosysController index action method.
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action index.");
        $this->view->user = $this->personModel->getAll('_ADMINISTRATOR_');
        $this->view->researcherArray = $this->personModel->getAll('_RESEARCHER_');
        $this->view->participantArray = $this->personModel->getAll('_PARTICIPANT_');
        $this->view->quizArray = $this->quizModel->getAll();
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