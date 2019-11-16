<?php

namespace mvc\view;


class View
{
    public function renderErrorPage() {

}

    public static function redirect($url)
    {
        header("location: /$url");
        exit;
    }


    /**
     * Simple redirect but it searches url in '/routes.php' by name
     */
    public static function redirectByName($url_name)
    {
        $routes = require 'routes.php';
        foreach ($routes as $url => $params) {
            if ($url_name == $params['name']) {
                self::redirect($url);
            }
        }
    }
}