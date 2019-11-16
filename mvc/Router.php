<?php

namespace mvc;
use mvc\view\View;

/**
 * Class Router
 * Takes routing from routes.php and creating controller due to routes.
 */
class Router
{
    /**
     * @var array Routes from routes.php placed here
     */
    public $routes;

    /**
     * @var array  Matched route params
     */
    public $params;

    /**
     * Router constructor. Fills this->routes.
     */
    public function __construct()
    {
        $routes = require 'routes.php';
        foreach ($routes as $url => $params) {
            $this->addRoute($url, $params);
        }
    }

    /**
     * Transforms url into a string, accepted by 'preg_match()'
     * and save it in '$this->routes'
     */
    private function addRoute($route, $params)
    {
        $route = '#^'.$route.'/?$#';
        $this->routes[$route] = $params;
    }

    /**
     * Finding controller due to routes and creating it. If there is no controller or method then throw errorpage.
     *
     * @object
     */
    public function run(){
        if ($this->isMatch()) {
            $controller = "app\controllers\\" . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($controller)) {
                $controller= new $controller($this->params);

                // Choose methods with Post (ex. loginPost) prefix if its a POST request.
                if (!empty($_POST)) {
                    $method = $this->params['action'].'Post';
                    $controller->$method($_POST);
                } else {
                    $method = $this->params['action'];
                    $controller->$method();
                }
            } else {
                View::renderErrorPage(404);
            }
        } else {
            View::renderErrorPage(404);
        }


    }

    /**
     * Searches match for url in registered routes
     * Fills this->params variable
     * Delete '/test' if your project is placed at parent dir.
     * @return bool
     */
    public function isMatch()
    {
        $url = ltrim($_SERVER['REQUEST_URI'], '/test/');
        // Remove get parameters from url
        $url = explode('?', $url)[0];

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }


}