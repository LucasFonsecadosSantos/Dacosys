<?php

namespace App\Controllers;

use Core\Controller;
use Core\Redirect;
use Core\Container;
use Core\DataBase;
use App\Models\QuizModel;
use App\Models\ItemModel;
use Util\Logger;

class QuizController extends Controller 
{

    private $itemModel;
    private $quizModel;
    private $participantAnswerItemModel;

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

    public function answer($id)
    {
        try {
            $this->view->quiz = $this->quizModel->getByID($id);
            $this->view->items = $this->itemModel->getFilteredByColumn('quiz_idQuiz',$id);
            $this->view->navigationRoute = [
                'Participar'          => '/participar',
                'Responder Questionário' => '/questionario/' . $id . '/responder'
            ];
            $this->loadView('quiz/quiz-answer');
        } catch (\Exception $e) {
            return Redirect::route('/participar',[
                'errors' => ['Ops: Parece que encontramos um erro ao buscar o questionário em questão. Por favor, contate o administrador do sistema.']
            ]);
        }
        
    }

    public function listation()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action listation.");
        
        try {
            $this->view->quizArray = $this->quizModel->getAll();
            $this->view->navigationRoute = [
                'Home' => '/',
                'Questionários' => '/questionarios'
            ];
            $this->loadView("quiz/list");
        } catch (\Exception $e) {
            return Redirect::route('/',[
                'errors' => ['Erro ao listar questionários do banco de dados. (' . $e->getMessage() . ')']
            ]);
        }
    }

    public function store($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        try {
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
        } catch (\Exception $e) {
            return Redirect::route('/questionarios',[
                'errors' => ['Erro ao cadastrar novo quetionário. (' . $e->getMessage() . ')']
            ]);
        }
    }

    public function itemStore($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        try {
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
        } catch (\Exception $e) {
            return Redirect::route('/questionario/' . $request->post->quiz_idQuiz . '/visualizar', [
                'errors' => ['Erro ao buscar perguntas do presente questionário. (' . $e->getMessage() . ')']
            ]);
        }
    }

    public function show($id)
    {
        
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action show.");

        try {
            $this->view->quiz               = $this->quizModel->getByID($id);
            $this->view->itemArray          = $this->itemModel->getFilteredByColumn('quiz_idQuiz',$id);
            $answeredItems                  = $this->participantAnswerItemModel->getAll();
            $this->view->answeredItemArray  = [];

            foreach ($this->view->itemArray as $item) {
                foreach ($answeredItems as $answeredItem)  {
                    if ($item->id_item == $answeredItem->item_idItem) {
                        array_push($this->view->answeredItemArray, $answeredItem);
                    }
                }
            }
            
            $this->view->navigationRoute = [
                'Home'          => '/',
                'Questionários' => '/questionarios',
                $this->view->quiz->name => '/questionarios/' . $this->view->quiz->id_quiz . '/visualizar' 
            ];
            
            $this->loadView("quiz/show");
        } catch (\Exception $e) {
            return Redirect::route('/questionarios', [
                'errors' => ['Erro ao buscar o questionário no banco de dados. (' . $e->getMessage() . ')']
            ]);
        }
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
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action delete.");
        try {
            $this->quizModel->delete($id);
            return Redirect::route('/questionarios',
                [
                    'success' => ['Questionário removido.']
                ]
            );
        } catch (\Exception $e) {
            return Redirect::route('/questionarios', [
                'errors' => ['Erro ao remover o questionário. (' . $e->getMessage() . ')']
            ]);
        }
    }

    public function metrics()
    {
        //TODO QuizController metrics action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action metrics.");
        // $this->loadView("home/index");
    }
}
