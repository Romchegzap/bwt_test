<?php

namespace app\controllers;

use app\validators\LoginUserValidator;
use app\validators\RegisterUserValidator;
use mvc\Controller;
use mvc\view\View;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{
    private $validationErrors = [];
    private $oldData = [];


    public function login()
    {
        if ($_SESSION['create_success'] == 'success') {
            $this->validationErrors[] = 'Registration success. Log in please.';
            $_SESSION['create_success'] = '';
        }
        $viewFile = 'login';
        $this->view->render('Login page', $viewFile, $this->validationErrors, $this->oldData);

    }

    public function loginPost($post)
    {
    $validator = new LoginUserValidator($post);
    $this->validationErrors = $validator->validate();
        if(!empty($this->validationErrors)){
            $this->oldData['email'] = $post['email'];
            $this->login();
            $this->validationErrors = [];
            $this->oldData = [];
        exit;
        } else {
            echo 'logged';
            $_SESSION['user_group'] = 'autorized';
            $_SESSION['user_name'] = $this->userRepository->getUserByEmail($post['email'])[0]['firstname'];
            $this->view->redirectByName('homepage');
        }
    }


    public function register(){
        $viewFile = 'register';
        $this->view->render('Register page', $viewFile, $this->validationErrors, $this->oldData);
    }

    public function registerPost($post){
        $validator = new RegisterUserValidator($post);
        $this->validationErrors = $validator->validate();
        if(!empty($this->validationErrors)){
            $this->oldData['firstname'] = $post['firstname'];
            $this->oldData['surname'] = $post['surname'];
            $this->oldData['email'] = $post['email'];
            $this->oldData['gender'] = $post['gender'];
            $this->register();
            $this->validationErrors = [];
            $this->oldData = [];
            exit;
        } else {
            unset($post['submit']);
            unset($post['passwordConfirmation']);
            if($this->userRepository->saveUser($post)){
                $_SESSION['create_success'] = 'success';
                $this->view->redirectByName('login');
            }
        }


//        foreach ($_POST as $post){
//            echo $post.'<br/>';
//        }
    }


    public function logout(){
        $_SESSION['user_group'] = 'guest';
        $_SESSION['user_name'] = '';
        $this->view->redirectByName('login');
    }
}