<?php

require 'mvc/adds/autoload.php';
require 'settings.php';
require 'dumper.php';

use mvc\model\Db;
use mvc\Router;

/**
 * Debug mode
 */
if (DEBUG) {
    require 'mvc/adds/debug.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

session_start();


if(!isset($_SESSION['user_group'])){
    $_SESSION['user_group'] = 'guest';
}


//$rule = ['email' => '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u'];
//$email = '123@asdasd.sd';
//var_dump(preg_match($rule['email'], $email));

//$rules = [
//    'email'  => [
//        'mask' => '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u'
//    ],
//    'password'  => [
//        'min'   => 5,
//        'max'   => 30
//    ]
//];
//$fields = [
//    'email'     =>  'vasya@vas.vas',
//    'password'  =>  '123123'
//    ];
//var_dump($fields['password'] > $rules['password']['max']);

//$fields = [
//    'firstname'   => 'Roma',
//    'surname'     => 'Abbi',
//    'email'       => 's3asd@ddd.asd',
//    'password'    => '113232',
//    'passwordConfirmation'    => '11321232',
//];
//$fields = [
//    'email'     =>  'vassya@vas.vas',
//    'password'  =>  '123123'
//    ];
//$rep = new \app\validators\LoginUserValidator($fields);
//var_dump($rep->validate());

//$pattern = '/^([0-9а-яА-Яa-zA-Z]{1})[-_\.0-9A-Za-zа-яА-Я]{1,}([-_\.0-9A-Za-zа-яА-Я])$/u';
//$pattern2 = '/^([а-яА-Яa-zA-Z0-9])/';
//$field = 'яяяaasddssd__ккп_asd-';
//
//var_dump(preg_match($pattern, $field));

//|([0-9а-яА-Я]{1}))
//$res = new \app\repositories\UserRepository();
//var_dump($res->getUserByEmail('333@3'));


//var_dump($rep->saveFeedback(
//    [
//        'name' => 'JOhn',
//        'message' => 'Hello ima John',
//        'email' => 'John@john.com'
//    ]
//));
//$router = new Router();
//$router->run();
//Delete later
//$dsn = "mysql:host=localhost;dbname=weather";
//$username = "root";
//$password = "";
//$db = new PDO($dsn, $username, $password);
//$stmt = $db->query('SELECT id FROM hallo')->fetchAll();
////while ($row = $stmt->fetch())
////{
////    echo $row['id'] . "\n";
////}
//var_dump($db); echo '<br/>';
//var_dump($stmt);echo '<br/>';
//
//$router = new Router();
////var_dump($router->routes);
//$router->isMatch();
////var_dump($router->params);
////dumper($router->params);
//$router->run();


//$db = new DB();
//
//$fields = [
//    'name'   => 'Ra',
//    'email'       => 'a3123aa@sdd.sd',
//    'message'     => 'Abbiasdasdas adsasdas adsdasd asdasdasd',
//
//];
//$rep = new \app\validators\PostFeedbackValidator($fields);
//var_dump($rep->validate());
//
//$rep = new \app\repositories\UserRepository();
//var_dump($rep->getUserByEmail('3@33'));
//$_SESSION['user_group'] = 'guest';
echo 'Session: user group - '.$_SESSION['user_group'].'<br/>';
echo 'Session: user name - '.$_SESSION['user_name'].'<br/>';
echo 'Session: create_success - '.$_SESSION['create_success'].'<br/>';
$rep = new Router();
$rep->run();
