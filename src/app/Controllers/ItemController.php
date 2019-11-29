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

    public function storeAnswer($id,$request)
    {
        try {
            print_r($request->post);
            $this->participantAnswerItemModel->create(
                [
                    'participant_idPerson'  =>  Session::get('user')['id_person'],
                    'item_idItem'           =>  $id,
                    'description'           =>  $request->post->description,
                    'answer'                =>  $request->post->answer,
                    'data_hour'             =>  DateHandle::getDateTime()
                ]
            );
            
            $nextID = Session::get('items_id')[0];
            if (($nextID != "") && (Session::get('items_id') != null) && ($nextID != null)) {
                $array = Session::get('items_id');
                array_shift($array);
                Session::set('items_id', $array);
                return Redirect::route('/pergunta/' . $nextID . '/responder');
            } else {
                return Redirect::route('/questionario/agradecimento');
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
            // return Redirect::route('/participar', [
            //     'errors' => ['Ops: Houve um erro ao salvar sua resposta. Por favor, contate o administrador.']
            // ]);
        }
    }


    public function answer($id)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ItemController, action answer.");
        
        try {
            print_r($_SESSION['items_id']);
            $this->view->item = $this->itemModel->getByID($id);
            
            $this->view->options = $this->_getOptions($this->view->item);

            $this->view->navigationRoute = [
                'Participar'          => '/participar',
                'Responder Questionário' => '/questionario/' . $this->view->item->quiz_idQuiz . '/responder',
                'Responder a pergunta' => '/questionario/' . $this->view->item->id_item . '/responder'
            ];

            $this->view->nextID = Session::get('items_id')[0];
            $array = Session::get('items_id');
            Session::set('items_id', $array);
            
            $this->loadView('item/answer');
            
        } catch (\Exception $e) {
            return Redirect::route('/participar',[
                'errors' => ['Ops, parece que houve um erro ao buscar a pergunta. Por favor, contate o administrador do sistema.']
            ]);
        }
    }

    private function _getOptions($item)
    {
        
        $image_options = [];
        
        try {

            if ($item->answer_type == '_DISCREET_') {

                $options = $this->itemHasPictureModel->getFilteredByColumn('item_idItem', $item->id_item);

                foreach ($options as $option) {
                
                    array_push($image_options, $this->itemPictureModel->getByID($option->item_picture_idPicture));
                
                }
            }
        
            return $image_options;

        } catch (\Exception $e) {
        
            return Redirect::route('/participar', [
                'errors' => ['Hmm, enfrentamos um erro ao carregar dados da pergunta. Por favor, entre em contato com o administrador do sistema.']
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