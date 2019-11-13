<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\QuizModel;
use Core\Container;
use Util\Logger;

class QuizController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        $this->view = new \stdClass;
    }

    public function register()
    {
        //TODO QuizController register action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action register.");
        // $this->loadView("home/index");
    }

    public function listation()
    {
        //TODO QuizController listation action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action listation.");
        $model = Container::getModelInstance("QuizModel");
        $quizArray = $model->getAll();
        print_r($quizArray);
    }

    public function store()
    {
        //TODO QuizController store action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        // $this->loadView("home/index");
    }

    public function show($id)
    {
        //TODO QuizController show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action show.");
        $model  = Container::getModelInstance("QuizModel");
        $quiz   = $model->getByID($id);
        print_r($quiz);
    }

    public function edit()
    {
        //TODO QuizController edit action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action edit.");
        // $this->loadView("home/index");
    }

    public function update()
    {
        //TODO QuizController update action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action update.");
        // $this->loadView("home/index");
    }

    public function delete()
    {
        //TODO QuizController delete action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action delete.");
        // $this->loadView("home/index");
    }

    public function metrics()
    {
        //TODO QuizController metrics action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action metrics.");
        // $this->loadView("home/index");
    }
}
