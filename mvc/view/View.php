<?php

namespace mvc\view;


class View
{
    public function renderErrorPage() {

}

    public static function redirect($url)
    {
        header("location: /test/$url");
        exit;
    }

    /**
     * Building html page.
     *
     * @param $title
     * @param $viewFile
     * @param array $errors
     * @param array $oldData
     */
    public function render($title, $viewFile, $errors = [], $oldData = [])
    {
        ob_start();
        $errorsAtPage = $errors;
        $oldDataAtPage = $oldData;
        require "app/views/{$viewFile}.php";
        $contentAtPage = ob_get_clean();
        $titleAtPage = $title;
        require 'app/views/layouts/default.php';

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