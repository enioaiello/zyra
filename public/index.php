<?php
// Chargement automatique des classes via Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Définition du chemin vers le dossier des vues
define('VIEWS', __DIR__ . '/../src/Views/');

use App\Router;

// Création d'une instance du routeur avec l'URL demandée
$router = new Router($_GET['url'] ?? '/');

// Définition des routes
$router->get('/', 'HomeController@index');

// Exécution du routeur pour traiter la requête
$router->run();
