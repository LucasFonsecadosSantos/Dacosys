<?php

namespace App\Controllers;

use App\Models\ParticipantAnswerItemModel;
use Core\Controller;
use App\Models\ParticipantModel;
use Core\Container;
use Core\DataBase;
use Core\Redirect;
use Util\DateHandle;
use Util\Identificator;
use Util\Logger;

class ParticipantController extends Controller 
{

    private $answerModel;
    private $participantModel;

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController instantiated.");
        parent::__construct('ParticipantModel');
        $connection             = DataBase::getInstance();
        $this->answerModel      = Container::getModelInstance('ParticipantAnswerItemModel', $connection);
        $this->participantModel = Container::getModelInstance('ParticipantModel', $connection);
        $this->view = new \stdClass;
    }

    public function listation()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action listation.");
        $this->view->$participantArray = $this->participantModel->getAll('_PARTICIPANT_');
        foreach ($this->view->$participantArray as $participant) {
            $participant->answer = $this->answerModel->getFilteredByColumn('participant_idPerson',$participant->id_person);
        }
        $this->loadView("participant/list");
    }

    public function register($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action register.");
        

        if ($this->view->participant = $this->isParticipant($request->post->access_key)) {
            $this->view->navigationRoute = [
                'Cadastre uma conta antes de utilizar o sistema' => '/participante/registrar'
            ];
            $this->loadView("participant/register");
        } else {
            // return Redirect::route('/participar',
            //     [
            //         'error' => ['Sua chave de acesso não é válida. Para participar, por favor, solicite uma nova chave ao pesquisador.']
            //     ]
            // );
        }

    }

    private function isParticipant($key) 
    {
        $participant = $this->participantModel->getByID('person_' . $key,'_PARTICIPANT_');
        return (isset($participant) && (!$participant->participated)) ? $participant : false;
    }

    public function login()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action login.");
        $this->loadView("participant/login");
    }

    public function store($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action store.");
        
        $personData = [
            'id_person'             => $request->post->id_person,
            'type'                  => '_PARTICIPANT_',
            'name'                  => $request->post->name,
            'email'                 => $request->post->email,
            'password'              => null,
            'participated'          => false,
            'sex'                   => $request->post->sex,
            'hometown_cep'          => $request->post->hometown_cep,
            'color'                 => $request->post->color,
            'birth_day'             => $request->post->birth_day,
            'latest_access'         => DateHandle::getDateTime(),
            'latest_ip_access'      => $_SERVER['REMOTE_ADDR'],
            'supervisor_idPerson'   => null
        ]
        
        $personData = $this->participantModel->prepareToInsert($personData);
        $dataTelephone = $this->telephoneModel->prepareToInsert($dataTelephone);
        
        
        try {
            $this->participantModel->create($personData);
            //ainda precisa adicionar os telefones
            //ainda precisa adicionar as necessidades epeciais
        } catch (\Exception $e) {
            return Redirect::route('/participar', [
                'errors' => ['Houve um erro ao realizarmos o seu cadastro. Por favor, contate o administrador do sistema.']
            ]);
        }
    }

    public function delete($id)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action delete.");
        try {
            $this->participantModel->delete($id);
            return Redirect::route('/participantes',[
                'success' => ['Tudo pronto! Removemos o participante.']
            ])
        } catch (\Exception $e) {
            return Redirect::route('/participantes', [
                'errors' => ['Ops: Parece que encontramos um problema ao remover o participante. Por favor, contate o administrador.']
            ]);
        }
    }

    public function show($id)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action show.");
        $participant = $this->model->getByID($id,'_PARTICIPANT_');
        print_r($participant);
    }

    public function edit()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action edit.");
        // $this->loadView("home/index");
    }

    public function update($id, $request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action update.");
        if ($this->model->update(
            [
                'id_person'             => $request->post->access_token,
                'type'                  => '_PARTICIPANT_',
                'name'                  => $request->post->name,
                'email'                 => $request->post->email,
                'password'              => null,
                'participated'          => false,
                'sex'                   => $request->post->sex,
                'hometown_cep'          => $request->post->hometown_cep,
                'color'                 => $request->post->color,
                'birth_day'             => $request->post->birth_day,
                'latest_access'         => $request->post->latest_access,
                'latest_ip_access'      => $_SERVER['REMOTE_ADDR'],
                'supervisor_idPerson'   => null
            ], $request->post->access_token
        )) {
            Redirect::route('/participantes');
        } else {
            echo 'Erro ao inserir no banco.';
        }
    }

    private function _prepareToInsert(array $data)
    {
        $data['hometown_cep'] = str_replace('-','',$data['hometown_cep']);
        //$telephoneArray = explode('@', $data['telephone']);
        // foreach ($telephoneArray as $telephone) {
        //     $telephone = str_replace('(','',$telephone);
        //     $telephone = str_replace(')','',$telephone);
        //     $telephone = str_replace(' ','',$telephone);
        //     $telephone = str_replace('-','',$telephone);
        // }
        return $data;
    }
}