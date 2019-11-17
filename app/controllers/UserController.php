<?php

namespace app\controllers;

use app\validators\LoginUserValidator;
use mvc\Controller;
use mvc\view\View;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{
    public function login(){
    echo 'HALLO';
    }

    public function loginPost($post){
    $validator = new LoginUserValidator($post);


    if ($validator->validate()){
        $_SESSION['user_group'] = 'autorized';
        View::redirect('');
    };
    }


    public function register(){

    }

    public function registerPost(){

    }
}