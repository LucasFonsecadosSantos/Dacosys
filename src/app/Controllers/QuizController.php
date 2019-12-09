<?php

namespace App\Controllers;

use Core\Controller;
use Core\Redirect;
use Core\Container;
use Core\DataBase;
use Core\Session;
use App\Models\QuizModel;
use App\Models\ItemModel;
use Util\Logger;
use Util\Uploader;
use Util\Identificator;
use Util\Parser;

class QuizController extends Controller 
{

    private $itemModel;
    private $quizModel;
    private $itemPictureModel;
    private $itemHasPictureModel;
    private $participantModel;
    private $participantAnswerItemModel;

    public function __construct() {
        Logger::log_message(Logger::LOG_INFORMATION, "DacosysController instantiated.");
        parent::__construct("QuizModel");
        $connection                         = DataBase::getInstance();
        $this->quizModel                    = Container::getModelInstance('QuizModel', $connection);
        $this->itemModel                    = Container::getModelInstance('ItemModel', $connection);
        $this->participantModel             = Container::getModelInstance('ParticipantModel', $connection);
        $this->itemPictureModel             = Container::getModelInstance('ItemPictureModel', $connection);
        $this->itemHasPictureModel          = Container::getModelInstance('ItemHasPictureModel', $connection);
        $this->participantModel             = Container::getModelInstance('ParticipantModel', $connection);
        $this->participantAnswerItemModel   = Container::getModelInstance('ParticipantAnswerItemModel', $connection);
        $this->view = new \stdClass;
    }

    public function register()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action register.");
        
        unset($_FILES);

        $this->view->navigationRoute = [
            'Home'          => '/',
            'Questionarios'          => '/questionarios',
            'Registrar Novo Questionário' => '/questionario/registrar'
        ];
        
        $this->loadView("quiz/register");
    }

    public function answer($id)
    {

        try {
            
            $this->view->quiz = $this->quizModel->getByID($id);
            
            $this->view->items = $this->itemModel->getFilteredByColumn('quiz_idQuiz',$id);
            
            $this->view->navigationRoute = [
                'Participar'          => '/participar',
                'Responder Questionário' => '/questionario/' . $id . '/responder'
            ];
            
            $itemsID = array();
            
            foreach ($this->view->items as $item) {
                array_push($itemsID, $item->id_item);
            }
            
            Session::set('items_id', $itemsID);

            $this->view->nextID = Session::get('items_id')[0];

            $array = Session::get('items_id');
            array_shift($array);
            Session::set('items_id', $array);
            
            $this->loadView('quiz/quiz-answer');

        } catch (\Exception $e) {
            
            return Redirect::route('/participar',[
                'errors' => ['Ops: Parece que encontramos um erro ao buscar o questionário em questão. Por favor, contate o administrador do sistema.']
            ]);
        
        }
        
    }

    public function thanks()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action thanks.");
        $this->loadView('quiz/thanks');
    }

    public function listation()
    {
        
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action listation.");
        
        try {
        
            $this->view->quizArray = $this->quizModel->getAll();
            $this->view->navigationRoute = [
                'Home' => '/',
                'Questionários' => '/questionarios'
            ];
            $this->loadView("quiz/list");
        
        } catch (\Exception $e) {
        
            return Redirect::route('/',[
                'errors' => ['Erro ao listar questionários do banco de dados. (' . $e->getMessage() . ')']
            ]);
        
        }
    }

    public function store($request)
    {
        
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        
        $quizId = Identificator::generateID('quiz_');

        try {
        
            $this->quizModel->create(
                [
                    'id_quiz'       => $quizId,
                    'name'          => $request->post->name,
                    'start_date'    => $request->post->start_date,
                    'end_date'      => $request->post->end_date,
                    'start_date'    => $request->post->start_date,
                    'status'        => true,
                    'description'   => $request->post->description
                ]
            );
        
            Logger::log_message(Logger::LOG_INFORMATION, "QuizController, new quiz object stored.");
        
            
        
        } catch (\Exception $e) {
        
            return Redirect::route('/questionarios',[
                'errors' => ['Erro ao cadastrar novo questionário. (' . $e->getMessage() . ')']
            ]);
        
        }

        try {

            $amount = (int) $request->post->token_amount;
            $idItem;
            
            for ($i=0; $i < $amount; ++$i) {
                
                $this->participantModel->create([

                    'id_person'             => Identificator::generateID("person_"),
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
                    'is_administrator'      => 0,
                    'observations'          => null,
                    'quiz_idQuiz'           => $quizId,
                    'supervisor_idPerson'   => null
                
                ]);

            }

            $this->itemStore($request);
        } catch (\Exception $e) {
            
            return Redirect::route('/questionarios',[+
                'errors' => ['Erro ao cadastrar os tokens. (' . $e->getMessage() . ')']
            ]);

        }

        // try {

        //     $items = [];
        //     $itemsImage = [];
        //     $size = count($request->post->item_answerEnunciation);
        //     print_r($request->post);
        //     foreach ($request->post->item_answerImages as $image) {
        //         print_r($image);
        //     }
        //     // for ($i = 0; $i < $size; ++$i) {
        //     //     $idItem = Identificator::generateID('item_');
                
        //     //     $items[$i] = [
        //     //         'id_item' => $idItem,
        //     //         'enunciation' => $request->post->item_answerEnunciation[$i],
        //     //         'quiz_idQuiz' => $quizId,
        //     //         'answer_type' => $request->post->item_answerType[$i],
        //     //         'answer_discret_amount' => null
        //     //     ];

        //     //     $count = 0;
                
        //     //     foreach ($request->post->item_answerImages as $image) {
        //     //         print_r($image);
        //     //     }
        //     //     //print_r($request->post->item_answerImages);
        //     //     // while(true) {
        //     //     //     if ($_FILES["item_answerImages_itemNumber".$count]) {
        //     //     //         $idImage = Identificator::generateID('item_picture_');

        //     //     //         $itemsImage[$count] = [
        //     //     //             'id_item_picture'   => $idImage,
        //     //     //             'title'             => '',
        //     //     //             'path'              => Uploader::makeUpload("item_answerImages_itemNumber".$count)
        //     //     //         ];

        //     //     //         unset($_FILES["item_answerImages_itemNumber".$count]);
        //     //     //         $count++;
        //     //     //     } else {
        //     //     //         break;
        //     //     //     }
        //     //     // }
                
        //     //     // do {

        //     //     //     if (isset($_FILES["item_answerImages_itemNumber0"])) {
                        
        //     //     //         $idImage = Identificator::generateID('item_picture_');

        //     //     //         $itemsImage[$i] = [
        //     //     //             'id_item_picture'   => $idImage,
        //     //     //             'title'             => '',
        //     //     //             'path'              => Uploader::makeUpload("item_answerImages_itemNumber".$count)
        //     //     //         ];
        //     //     //     }
        //     //     //     ++$count;
        //     //     //     unset($_FILES['item_answerImages_itemNumber'.$count]);
        //     //     // } while (isset($_FILES["item_answerImages_itemNumber".$count]));

        //     //     //print_r($itemsImage[0]['path']);
        //     //     //$images = Parser::getItemImage($request->post->item_answerImages[$i]);
            
        //     //     // $imageAmount = count($images);

        //     //     // for ($j = 0; $j < $imageAmount; ++$j) {
                    
        //     //     //     $idImage = Identificator::generateID('item_picture_');

        //     //     //     $itemsImage[$i] = [
        //     //     //         'id_item_picture'   => $idImage,
        //     //     //         'title'             => '',
        //     //     //         'path'              => Uploader::makeUpload($images[$j])
        //     //     //     ];

        //     //     // }

        //     // }

            
            
        //     //print_r($_POST);
        //     // foreach ($request->post->item_row as $item) {

        //     //     $idItem = Identificator::generateID('item_');

        //     //     $this->itemModel->create([

        //     //         'id_item'               => $idItem,
        //     //         'enunciation'           => $request->post->enunciation,
        //     //         'quiz_idQuiz'           => $quizId,
        //     //         'answer_type'           => $request->post->answer_type,
        //     //         'answer_discret_amount' => null
                
        //     //     ]);

        //     //     //TODO create image and item_+has_image

        //     // }
            

        //     // return Redirect::route('/questionarios', [
        //     //     'success' => ['Tudo ok! Seu questionário foi registrado.']
        //     // ]);

        // } catch (\Exception $e) {

        //     return Redirect::route('/questionarios', [
        //         'errors' => ['Ops: Parece que houve um problema ao salvar o questionário.']
        //     ]);

        // }
        // try {

        //     return Redirect::route("/questionarios",
        //         [
        //             "success" => ["Questionário registrado com sucesso."]
        //         ]
        //     );

        // } catch (\Exception $e) {
            
        //     return Redirect::route('/questionarios',[
        //         'errors' => ['Erro ao cadastrar as imagens. (' . $e->getMessage() . ')']
        //     ]);

        // }
    }

    public function itemStore($request)
    {
        
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action store.");
        
        try {
        
            $this->quizModel->create(
                [
                    'id_item'               => Identificator::generateID('item_'),
                    'enunciation'           => $request->post->enunciation,
                    'quiz_idQuiz'           => $request->post->quiz_idQuiz,
                    'answer_type'           => $request->post->answer_type,
                    'answer_discret_amount' => $request->post->answer_discret_amount
                ]
            );
        
            Logger::log_message(Logger::LOG_INFORMATION, "QuizController, new quiz object stored.");
        
            return Redirect::route("/questionario/" . $request->post->quiz_idQuiz . "/visualizar",
                [
                    "success" => ["Questionário registrado com sucesso."]
                ]
            );
        
        } catch (\Exception $e) {
        
            return Redirect::route('/questionario/' . $request->post->quiz_idQuiz . '/visualizar', [
                'errors' => ['Erro ao buscar perguntas do presente questionário. (' . $e->getMessage() . ')']
            ]);
        
        }
    }

    public function show($id)
    {
        
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action show.");

        try {
        
            $this->view->quiz               = $this->quizModel->getByID($id);
            $this->view->itemArray          = $this->itemModel->getFilteredByColumn('quiz_idQuiz',$id);
            $this->view->participantArray   = $this->participantModel->getFilteredByColumn('quiz_idQuiz', $id);
            //$this->view->answerArray        = $this->participantAnswerItemModel->getFilteredByColumn('quiz_idQuiz', $id)

            $this->view->navigationRoute = [
                'Home'          => '/',
                'Questionários' => '/questionarios',
                $this->view->quiz->name => '/questionarios/' . $this->view->quiz->id_quiz . '/visualizar' 
            ];
            
            $this->loadView("quiz/show");
        
        } catch (\Exception $e) {
        
            return Redirect::route('/questionarios', [
                'errors' => ['Erro ao buscar o questionário no banco de dados. (' . $e->getMessage() . ')']
            ]);
        
        }
    }

    public function edit()
    {
        //TODO QuizController edit action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action edit.");
        // $this->loadView("home/index");
    }

    public function update()
    {
        //TODO QuizController update action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action update.");
        // $this->loadView("home/index");
    }

    public function delete($id)
    {
       
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action delete.");
       
        try {
       
            $this->quizModel->delete($id);
       
            return Redirect::route('/questionarios',
                [
                    'success' => ['Questionário removido.']
                ]
            );
       
        } catch (\Exception $e) {
       
            return Redirect::route('/questionarios', [
                'errors' => ['Erro ao remover o questionário. (' . $e->getMessage() . ')']
            ]);
       
        }
    }

    public function metrics()
    {
        //TODO QuizController metrics action method.
        Logger::log_message(Logger::LOG_INFORMATION, "QuizController, action metrics.");
        // $this->loadView("home/index");
    }
}
