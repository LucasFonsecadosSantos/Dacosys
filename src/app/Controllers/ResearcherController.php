<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\Controller;
use Core\DataBase;
use Core\Container;
use Util\Logger;
use Util\Identificator;

class ResearcherController extends Controller 
{

    use Authenticate;

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
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action register.");
        $this->view->navigationRoute = [
            'Home' => '/',
            'Pesquisadores' => '/pesquisadores',
            'Cadastrar novo pesquisador' => '/pesquisador/registrar',
        ];
        $this->loadView("researcher/register");
    }

    public function listation()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action listation.");
        
        try {
            $this->view->researcherArray = $this->personModel->getAll('_RESEARCHER_');
            $this->view->navigationRoute = [
                'Home' => '/',
                'Pesquisadores' => '/pesquisadores'
            ];
            $this->loadView("researcher/list");
        } catch (\Exception $e) {
            return Redirect::route('/', [
                'errors' => ['Erro ao buscar pesquisadores no banco de dados. (' . $e->getMessage() . ')']
            ]);
        }
        
    }

    public function store($request)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action store.");
        $isAdmin = ($request->post->id_person != null) ? false : true;
        $idPerson = ($request->post->id_person != null) ? $request->post->id_person : Identificator::generateID('person_');
        
        try {
            $this->personModel->create(
                [
                    'id_person'             => $idPerson,
                    'type'                  => '_RESEARCHER_',
                    'name'                  => $request->post->name,
                    'email'                 => $request->post->email,
                    'password'              => password_hash($request->post->password, PASSWORD_BCRYPT),
                    'participated'          => 1,
                    'sex'                   => $request->post->sex,
                    'hometown_cep'          => $request->post->hometown_cep,
                    'color'                 => $request->post->color,
                    'birth_day'             => $request->post->birth_day,
                    'latest_access'         => DateHandle::getDateTime(),
                    'latest_ip_access'      => $_SERVER['REMOTE_ADDR'],
                    'is_administrator'      => $isAdmin,
                    'supervisor_idPerson'   => null
                ]
            );
            return Redirect::route("/pesquisadores",[
                    'sucess' => ['Pesquisador registrado com sucesso!']
                ]
            );
        } catch (\Exception $e) {
            return Redirect::route("/pesquisadores",[
                    'errors' => ['Erro ao cadastrar nova entidade. (' . $e->getMessage() . ')']
                ]
            );
        }
    }

    public function delete($id)
    {
        //TODO Researcher delete action method.
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action delete.");
        try {
            $this->personModel->delete($id);
        } catch (\Exception $e) {
            return Redirect::route('/pesquisadores',[
                'errors' => ['Erro ao remover pesquisador. (' . $e->getMessage() . ')']
            ]);
        }
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
        // foreach ($this-)

        try {
            $this->view->person = $this->prepareToView($this->personModel->getByID($id, '_RESEARCHER_'));

            $this->view->navigationRoute = [
                'Home'          => '/',
                'Pesquisadores' => '/pesquisadores',
                $this->view->person->name => '/pesquisadores/' . $this->view->person->id_person . '/visualizar' 
            ];
        } catch (\Exception $e) {
            $this->view->navigationRoute = [
                'Home'          => '/',
                'Pesquisadores' => '/pesquisadores'
            ];
            return Redirect::route('/pesquisadores',[
                'errors' => ['Erro ao buscar pesquisador. (' . $e->getMessage() . ')']
            ]);
        }


        $this->loadView('researcher/show');
    }

    private function prepareToView($person)
    {
        switch ($person->color) {
            case '_PRETA_':
                $person->color = 'Preta';
                break;
            case '_BRANCA_':
                $person->color = 'Branca';
                break;
            case '_INDIGENA_':
                $person->color = 'Indigena';
                break;
            case '_PARDA_':
                $person->color = 'Parda';
                break;
            case '_AMARELA_':
                $person->color = 'Amarela';
                break;

        }

        switch ($person->sex) {
            case '_M_':
                $person->sex = 'Masculino';
                break;
            case '_F_':
                $person->sex = 'Feminino';
                break;
            case '_O_':
                $person->sex = 'Outro ou Não Informado';
                break;
        }

        switch ($person->type) {
            case '_RESEARCHER_':
                $person->function = 'Pesquisador';
                break;
            case '_PARTICIPANT_':
                $person->function = 'Participante';
                break;
            case '_ADMINISTRATOR_':
                $person->function = 'Administrador';
                break;
        }

        return $person;
    }
}