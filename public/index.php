<?php

use App\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

// Définition du chemin vers le dossier des vues
define('VIEWS', __DIR__ . '/../src/Views/');

// Création d'une instance du routeur avec l'URL demandée
$router = new \App\Core\Router($_SERVER['REQUEST_URI']);

// Définition des routes
$router->get('/', 'HomeController@index');

// Exécution du routeur pour traiter la requête
$router->run();