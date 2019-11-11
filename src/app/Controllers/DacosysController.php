<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\PersonModel;
use Core\Container;
use Core\DataBase;
use PDO;

class DacosysController extends Controller 
{

    public function __construct() {
        $this->view = new \stdClass;
    }

    public function index()
    {
        $this->loadView("home/index");
    }
}