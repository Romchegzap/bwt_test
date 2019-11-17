<?php

namespace app\controllers;


use mvc\Controller;

/**
 * Class MainController
 * @package app\controllers
 */
class MainController extends Controller
{

    public function index(){

        $this->view->render('Main page', 'main');
    }



    public function postFeedback(){

    }
}