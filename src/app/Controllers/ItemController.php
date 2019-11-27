<?php

namespace App\Controllers;

use App\Models\ItemModel;
use Core\Controller;
use Core\DataBase;
use Core\Container;
use Core\Redirect;
use Util\Identificator;
use Util\Logger;
use Util\Parser;

class ItemController extends Controller 
{

    private $itemModel;

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        parent::__construct('ItemModel');
        $connection = DataBase::getInstance();
        $this->itemModel = Container::getModelInstance('ItemModel', $connection);
        $this->view = new \stdClass;
    }

    public function register()
    {
        //TODO ItemController register action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action register.");
        // $this->loadView("item/register");
    }

    public function listation()
    {
        //TODO ItemController key generation store method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action listation.");
        $itemArray = $this->model->getAll();
        print_r($itemArray);
    }

    public function store($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action store.");
        $this->model->create(
            [
                'id_item' => Identificator::generateID('_item'),
                'quiz_idQuiz'           => $request->post->quiz_idQuiz,
                'answer_type'           => $request->post->answer_type,
                'answer_discret_amount' => $request->post->answer_discret_amount
            ]
        );
        return Redirect::route(
            '/questionario/' . $request->post->quiz_idQuiz . '/visualizar',
            [
                'success' => ['Tudo ok! A sua nova pergunta foi cadastrada.']
            ]
        );
    }

    public function show($id)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action show.");
        $item = $this->itemModel->getFilteredByColumn('id_item',$id);
        $this->loadView("item/show");
    }

    public function answer($id, $request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action answer.");
        try {
            $this->view->item = $this->itemModel->getByID($id);
            $this->view->navigationRoute = [
                'Participar'          => '/participar',
                'Responder Questionário' => '/questionario/' . $this->view->item->quiz_idQuiz . '/responder',
                'Responder a pergunta' => '/questionario/' . $this->view->item->id_item . '/responder'
            ];
            $this->view->idItems    = Parser::getIdItemsArrayString($request->post->id_item_list);
            print_r($this->view->idItems);
            // $this->view->nextID     = Parser::getFirstID($this->view->idItems);
            // $this->view->idItems    = Parser::removeFirstIndex($this->view->idItems);

            // $this->loadView('item/answer');
        } catch (\Exception $e) {
            return Redirect::route('/participar',[
                'errors' => ['Ops, parece que houve um erro ao buscar a pergunta. Por favor, contate o administrador do sistema.']
            ]);
        }
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

    public function delete($id)
    {
        //TODO ItemController answer delete method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action delete.");
        if ($this->itemModel->delete($id)) {
            Redirect::route('/perguntas');
        } else {
            echo 'Erro ao concluir!';
        }
    }
}