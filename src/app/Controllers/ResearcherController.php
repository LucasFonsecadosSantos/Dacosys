<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\Controller;
use Core\DataBase;
use Core\Container;
use Core\Redirect;
use Util\Logger;
use Util\DateHandle;
use Util\Identificator;

class ResearcherController extends Controller 
{

    use Authenticate;

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher instantiated.");
        parent::__construct('ResearcherModel');
        $connection = DataBase::getInstance();
        $this->researcherModel = Container::getModelInstance('ResearcherModel', $connection);
        $this->telephoneModel = Container::getModelInstance('TelephoneModel', $connection);
        $this->view = new \stdClass;
    }

    public function register()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action register.");
        // $this->view->navigationRoute = [
        //     'Home' => '/',
        //     'Pesquisadores' => '/pesquisadores',
        //     'Cadastrar novo pesquisador' => '/pesquisador/registrar',
        // ];
        $this->view->navigationRoute = [
            'Cadastre uma conta antes de utilizar o sistema' => '/pesquisador/cadastrar'
        ];
        $this->loadView("researcher/register");
    }

    public function listation()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action listation.");
        
        try {
            $this->view->researcherArray = $this->researcherModel->getAll('_RESEARCHER_');
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
        
        $dataPerson = [
            'id_person'             => $request->post->id_person,
            'type'                  => '_RESEARCHER_',
            'name'                  => $request->post->name_person,
            'email'                 => $request->post->email,
            'password'              => password_hash($request->post->password, PASSWORD_BCRYPT),
            'participated'          => 1,
            'sex'                   => $request->post->sex,
            'hometown_cep'          => $request->post->hometown_cep,
            'color'                 => $request->post->color,
            'birth_day'             => $request->post->birth_day,
            'latest_access'         => DateHandle::getDateTime(),
            'latest_ip_access'      => $_SERVER['REMOTE_ADDR'],
            'is_administrator'      => "",
            'observations'          => null,
            'supervisor_idPerson'   => null
        ];

        $dataPerson = $this->researcherModel->prepareToInsert($dataPerson);
        
        $dataTelephone = [
            'person_idPerson' => $dataPerson['id_person'],
            'telephone' => $request->post->all_telephone
        ];
        $dataTelephone = $this->telephoneModel->prepareToInsert($dataTelephone);
        
        try {
            $this->researcherModel->create($dataPerson);

            if ($dataTelephone['telephone'] != "" || $dataTelephone['telephone']) {
                foreach ($dataTelephone['telephone'] as $telephone) {
                    $this->telephoneModel->create([
                        'person_idPerson' => $dataPerson['id_person'],
                        'telephone' => $telephone
                    ]);
                }
            }
            return Redirect::route("/pesquisadores",[
                    'sucess' => ['Pesquisador registrado com sucesso!']
                ]
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
            // return Redirect::route("/bosta",[
            //         'errors' => ['Erro ao cadastrar nova entidade. (' . $e->getMessage() . ')']
            //     ]
            // );
        }
    }

    public function delete($id)
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action delete.");
        try {
            $this->researcherModel->delete($id);
            return Redirect::route('/pesquisadores',[
                'success' => ['Pronto! Já removemos o pesquisador para você.']
            ]);
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
        Logger::log_message(Logger::LOG_INFORMATION, "Researcher, action show.");

        try {
            $this->view->person = $this->researcherModel->prepareToView($this->researcherModel->getByID($id, '_RESEARCHER_'));

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

}