<?php

namespace App\Controllers;

use Core\Controller;
use Core\Redirect;
use Core\Container;
use Core\DataBase;
use App\Models\QuizModel;
use Util\Logger;

class QuizController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        parent::__construct("QuizModel");
        $connection                         = DataBase::getInstance();
        $this->quizModel                    = Container::getModelInstance('QuizModel', $connection);
        $this->itemModel                    = Container::getModelInstance('ItemModel', $connection);
        $this->participantAnswerItemModel   = Container::getModelInstance('ParticipantAnswerItemModel', $connection);
        $this->view = new \stdClass;
    }

    public function register()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action register.");
        $this->loadView("quiz/register");
    }

    public function listation()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action listation.");
        $this->view->quizArray = $this->quizModel->getAll();
        $this->loadView("quiz/list");
    }

    public function store($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        $this->quizModel->create(
            [
                'id_quiz'       => Indentificator::generateID('quiz_'),
                'start_date'    => $request->post->start_date,
                'end_date'      => $request->post->end_date,
                'start_date'    => $request->post->start_date,
                'status'        => true
            ]
        );
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, new quiz object stored.");
        return Redirect::route("/questionarios",
            [
                "success" => ["Questionário registrado com sucesso."]
            ]
        );
    }

    public function itemStore($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        $this->quizModel->create(
            [
                'id_item'               => Indentificator::generateID('item_'),
                'enunciation'           => $request->post->enunciation,
                'quiz_idQuiz'           => $request->post->quiz_idQuiz,
                'answer_type'           => $request->post->answer_type,
                'answer_discret_amount' => $request->post->answer_discret_amount
            ]
        );
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, new quiz object stored.");
        return Redirect::route("/questionario/" . $request->post->quiz_idQuiz . "/visualizar",
            [
                "success" => ["Questionário registrado com sucesso."]
            ]
        );
    }

    public function show($id)
    {
        
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action show.");

        $this->view->quiz   = $this->quizModel->getByID($id);
        $this->view->itemArray = $this->itemModel->getFilteredByColumn('quiz_idQuiz',$id);
        $this->view->answeredItems = $this->participantAnswerItemModel->getFilteredByColumn('quiz_idQuiz',$id);
        
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

    public function delete($id)
    {
        //TODO QuizController delete action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action delete.");
        $this->quizModel->delete($id);
        return Redirect::route('/questionarios',
            [
                'success' => ['Questionário removido.']
            ]
        );
    }

    public function metrics()
    {
        //TODO QuizController metrics action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action metrics.");
        // $this->loadView("home/index");
    }
}
