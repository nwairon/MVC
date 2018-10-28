<?php
//error_reporting(E_STRICT);
declare(strict_types=1);

// Require the controller class
//require '../App/Controllers/Posts.php';

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

/*
// Display the routing table
echo '<pre>';
//var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
echo '</pre>';

// Match requested route
$url = $_SERVER['QUERY_STRING'];

if($router->match($url)){
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
}else{
    echo "No route found for URL '$url'";
}
*/

$router->dispatch($_SERVER['QUERY_STRING']);