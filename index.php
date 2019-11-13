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
//Delete later
$dsn = "mysql:host=localhost;dbname=weather";
$username = "root";
$password = "";
$db = new PDO($dsn, $username, $password);
$stmt = $db->query('SELECT id FROM hallo')->fetchAll();
//while ($row = $stmt->fetch())
//{
//    echo $row['id'] . "\n";
//}
var_dump($db); echo '<br/>';
var_dump($stmt);echo '<br/>';

$router = new Router();
//var_dump($router->routes);
$router->isMatch();
//var_dump($router->params);
//dumper($router->params);
$router->run();

$db = new DB();
