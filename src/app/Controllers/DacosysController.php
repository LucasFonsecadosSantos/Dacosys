<?php

namespace App\Controllers;

use Core\Controller;
use Core\Container;
use Core\Redirect;
use Core\DataBase;
use Util\Logger;

class DacosysController extends Controller 
{

    public function __construct() 
    {    
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        
        parent::__construct('PersonModel');

        $connection         = DataBase::getInstance();
        $this->personModel  = Container::getModelInstance('ResearcherModel', $connection);
        $this->quizModel    = Container::getModelInstance('QuizModel', $connection);
        $this->view         = new \stdClass;
    }

    public function index()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action index.");
        
        try {
            
            $this->view->user               = $this->personModel->getAll('_ADMINISTRATOR_');
            $this->view->researcherArray    = $this->personModel->getAll('_RESEARCHER_');
            $this->view->participantArray   = $this->personModel->getAll('_PARTICIPANT_');
            $this->view->quizArray          = $this->quizModel->getAll();
            $this->view->navigationRoute = [
                'Dashboard de controle' => '/',
            ];
            
            $this->loadView("home/index");
        
        } catch (\Exception $e) {
            
            return Redirect::route("/500", [
                'errors' => ['Hmm, parece que não foi possivel carregar alguns dados da aplicação. Por favor, contate o administrador do sistema.']
            ]);

        }
    }

    public function keyGeneration($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action key generation.");
        
        try {
        
            $this->personModel->create(
                [
                    'id_person'             => Indentificator::generateID("person_"),
                    'type'                  => '_PARTICIPANT_',
                    'name'                  => null,
                    'email'                 => null,
                    'password'              => null,
                    'sex'                   => null,
                    'hometown_cep'          => null,
                    'color'                 => null,
                    'birth_day'             => null,
                    'latest_access'         => null,
                    'latest_ip_access'      => null,
                    'supervisor_idPerson'   => null,
                ]
            );
        
            $this->loadView("home/accesskey");
        
        } catch (\Exception $e) {
        
            return Redirect::route('/',[
                'errors' => ['Erro ao cadastrar novo participante no banco de dados. (' . $e->getMessage() . ')']
            ]);
        
        }
    }

    public function bugReport()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action bug report.");
        $this->loadView("home/bug-report");
    }

    public function about()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action about.");
        $this->loadView('home/about');
    }

    public function login()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action login.");
        $this->loadView('home/login');
    }

    public function participantLogin()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController, action participantLogin.");
        $this->loadView('home/participant-login');
    }

}