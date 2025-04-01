<?php
require_once __DIR__ . '/../vendor/autoload.php';

define('VIEWS', __DIR__ . '/../src/Views/');

use App\Router;

$router = new Router($_GET['url'] ?? '/');

// Définition des routes
$router->get('/', 'HomeController@index');

$router->run();
