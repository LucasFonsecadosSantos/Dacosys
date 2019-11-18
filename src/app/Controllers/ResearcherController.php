<?php

namespace App\Controllers;

use Core\Controller;
use Core\DataBase;
use Core\Container;
use Util\Logger;
use Util\Identificator;

class ResearcherController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher instantiated.");
        parent::__construct('ResearcherModel');
        $connection = DataBase::getInstance();
        $this->personModel = Container::getModelInstance('ResearcherModel', $connection);
        //$this->telephoneModel = Container::getModelInstance('TelephoneModel', $connection);
        $this->view = new \stdClass;
    }

    public function register()
    {
        //TODO Researcher register action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action register.");
        $this->loadView("researcher/register");
    }

    public function login()
    {
        //TODO Researcher login action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action login.");
        $this->loadView("home/login");
    }

    public function listation()
    {
        //TODO Researcher listation action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action listation.");
        $this->view->researcherArray = $this->personModel->getAll('_RESEARCHER_');
        $this->loadView("researcher/list");
    }

    public function store($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action store.");
        $this->personModel->create(
            [
                'id_person'             => Indentificator::generateID('person'),
                'type'                  => '_RESEARCHER_',
                'name'                  => $request->post->name,
                'email'                 => $request->post->email,
                'password'              => $request->post->password,
                'access_key'            => null,
                'participated'          => null,
                'sex'                   => $request->post->sex,
                'hometown_cep'          => $request->post->hometown_cep,
                'color'                 => $request->post->color,
                'birth_day'             => $request->post->birth_day,
                'latest_access'         => DateHandle::getDateTime(),
                'latest_ip_access'      => $_SERVER['REMOTE_ADDR'],
                'supervisor_idPerson'   => null
            ]
        );
        return Redirect::route("/pesquisadores",
            [
                'sucess' => ['Pesquisador registrado com sucesso!']
            ]
        );
    }

    public function delete($id)
    {
        //TODO Researcher delete action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action delete.");
        $this->personModel->delete($id);
    }

    public function update()
    {
        //TODO Researcher update action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action update.");
        // $this->loadView("home/index");
    }

    public function show($id)
    {
        //TODO Researcher show action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action show.");
        $this->view->person = $this->personModel->getByID($id, '_RESEARCHER_');
        // foreach ($this-)
        $this->loadView('researcher/show');
    }
}