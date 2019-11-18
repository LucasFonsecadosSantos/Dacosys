<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\QuizModel;
use Core\Container;
use Core\DataBase;
use Util\Logger;

class QuizController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        parent::__construct("QuizModel");
        $connection         = DataBase::getInstance();
        $this->quizModel    = Container::getModelInstance('QuizModel', $connection);
        $this->itemModel    = Container::getModelInstance('ItemModel', $connection);
        $this->view = new \stdClass;
    }

    public function register()
    {
        //TODO QuizController register action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action register.");
        // $this->loadView("quiz/register");
    }

    public function listation()
    {
        //TODO QuizController listation action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action listation.");
        $this->view->quizArray = $this->quizModel->getAll();
        $this->loadView("quiz/list");
    }

    public function store($request)
    {
        //TODO QuizController store action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        $this->quizModel->create(
            [
                //'id_quiz' => indentificator.generateID();
                'start_date' => $request->post->start_date,
                'end_date' => $request->post->end_date,
                'start_date' => $request->post->start_date
                //'status' => verificar data de abertura
            ]
        );
    }

    public function show($id)
    {
        //TODO QuizController show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action show.");
        $this->view->quiz   = $this->quizModel->getByID($id);
        $this->view->itemArray = $this->itemModel->getFilteredByColumn('quiz_idQuiz',$id);
        $this->loadView("quiz/show");
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
