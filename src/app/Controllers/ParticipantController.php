<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ParticipantModel;
use Core\Container;
use Util\Logger;

class ParticipantController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController instantiated.");
        $this->view = new \stdClass;
    }

    public function register()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action register.");
        // $this->loadView("home/index");
    }

    public function login()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action login.");
        // $this->loadView("home/index");
    }

    public function store()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action store.");
        // $this->loadView("home/index");
    }

    public function delete()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action delete.");
        // $this->loadView("home/index");
    }

    public function show()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action show.");
        // $this->loadView("home/index");
    }

    public function edit()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action edit.");
        // $this->loadView("home/index");
    }

    public function update()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action update.");
        // $this->loadView("home/index");
    }
}