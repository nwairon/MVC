<?php
//error_reporting(E_STRICT);
declare(strict_types=1);

//echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

/**
 * Routing
 */
require '../Core/Router.php';

$router = new Router();

echo get_class($router);