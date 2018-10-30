<?php
//error_reporting(E_STRICT);
declare(strict_types=1);

/**
 * Twig
 */
//require_once dirname(__DIR__) . '/vendor/autoloader.php';
Twig_Autoloader::register();

/**
 * Autoloader
 */
spl_autoload_register(function ($class){
    $root = dirname(__DIR__);   // get parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_readable($file)){
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

/**
 * Routing
 */
//require '../Core/Router.php';

$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->dispatch($_SERVER['QUERY_STRING']);