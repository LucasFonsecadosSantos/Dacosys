<?php

namespace App\Controllers;

use Core\Controller;

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