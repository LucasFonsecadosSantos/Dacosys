<?php

namespace App\Controllers;

use App\Models\ParticipantAnswerItemModel;
use Core\Controller;
use App\Models\ParticipantModel;
use Core\Container;
use Core\DataBase;
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

    public function register()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action register.");
        // $this->loadView("participant/register");
    }

    public function login()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action login.");
        // $this->loadView("home/index");
    }

    public function store()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action store.");
        $token = Identificator::generateID('participant');
        $this->model->create(
            [
                'id_person'             => $token,
                'type'                  => '_PARTICIPANT_',
                'name'                  => null,
                'email'                 => null,
                'password'              => null,
                'participated'          => false,
                'sex'                   => null,
                'hometown_cep'          => null,
                'color'                 => null,
                'birth_day'             => null,
                'latest_access'         => null,
                'latest_ip_access'      => $_SERVER['REMOTE_ADDR'],
                'supervisor_idPerson'   => null
            ]
        );
        // $this->loadView("participante/gerar-token");
        // $this->view->token = $token;
    }

    public function delete()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "ParticipantController, action delete.");
        // $this->loadView("home/index");
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
}