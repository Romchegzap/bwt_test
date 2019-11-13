<?php
namespace mvc\adds;

/**
 * Autoloader
 */
spl_autoload_register(function($class) {
    $path = $class . '.php';
    $path = str_replace('\\', '/', $path);

        require $path;

}
);