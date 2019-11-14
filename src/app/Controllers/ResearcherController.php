<?php

namespace App\Controllers;

use Core\Controller;
use Core\Container;
use Util\Logger;
use Util\Identificator;

class ResearcherController extends Controller 
{

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher instantiated.");
        parent::__construct('ResearcherModel');
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
        $this->loadView("researcher/list");
        $researcherArray = $this->model->getAll('_RESEARCHER_');
        print_r($researcherArray);
    }

    public function store($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action store.");
        $this->model->create(
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

    public function delete()
    {
        //TODO Researcher delete action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action delete.");
        // $this->loadView("home/index");
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
        $researcher = $this->model->getByID($id, '_RESEARCHER_');
        print_r($researcher);
    }
}