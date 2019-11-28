<?php

namespace App\Controllers;

use App\Models\ItemModel;
use Core\Controller;
use Core\DataBase;
use Core\Container;
use Core\Redirect;
use Core\Session;
use Util\Identificator;
use Util\Logger;
use Util\DateHandle;
use Util\Parser;

class ItemController extends Controller 
{

    private $itemModel;
    private $telephoneModel;
    private $participantAnswerItemModel;
    private $itemHasPictureModel;
    private $itemPictureModel;

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        parent::__construct('ItemModel');
        $connection                         = DataBase::getInstance();
        $this->itemModel                    = Container::getModelInstance('ItemModel', $connection);
        $this->participantAnswerItemModel   = Container::getModelInstance('ParticipantAnswerItemModel', $connection);
        $this->itemHasPictureModel          = Container::getModelInstance('ItemHasPictureModel', $connection);
        $this->itemPictureModel             = Container::getModelInstance('ItemPictureModel', $connection);
        $this->view = new \stdClass;
    }

    public function register()
    {
        //TODO ItemController register action method.
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action register.");
        // $this->loadView("item/register");
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

    public function storeAnswer($request)
    {
        try {
            //print_r($request->post);
            // $this->participantAnswerItemModel->create(
            //     [
            //         'participant_idPerson'  =>  Session::get('user')['id_person'],
            //         'item_idItem'           =>  Session::get('id_item'),
            //         'description'           =>  $request->post->description,
            //         'answer'                =>  $request->post->answer,
            //         'data_hour'             =>  DateHandle::getDateTime()
            //     ]
            // );
        } catch (\Exception $e) {
            echo $e->getMessage();
            // return Redirect::route('/participar', [
            //     'errors' => ['Ops: Houve um erro ao salvar sua resposta. Por favor, contate o administrador.']
            // ]);
        }
    }


    public function answer($id, $request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action answer.");
        
        try {
            
            $this->view->item = $this->itemModel->getByID($id);
            $this->view->options = null;

            if ($this->view->item->answer_type == '_DISCREET_') {
                $this->view->options = $this->itemHasPictureModel->getFilteredByColumn('item_idItem', $id);
                $this->view->image_options = [];
                foreach ($this->view->options as $option) {
                    array_push($this->view->image_options, $this->itemPictureModel->getByID($option->item_picture_idPicture));
                }
            }

            $this->view->navigationRoute = [
                'Participar'          => '/participar',
                'Responder Questionário' => '/questionario/' . $this->view->item->quiz_idQuiz . '/responder',
                'Responder a pergunta' => '/questionario/' . $this->view->item->id_item . '/responder'
            ];

            $this->view->nextID = Session::get('items_id')[0];
            
            Session::set('items_id', [Parser::getID(Session::get('items_id')[1]),Parser::shiftID(Session::get('items_id')[0], Session::get('items_id')[1])]);
            //$this->view->idItems = Parser::shiftID($this->view->nextID, $request->post->id_item_list);

            Session::set('id_item',$id);
            print_r($_SESSION);

            //$this->loadView('item/answer');
            
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