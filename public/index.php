<?php

use App\Core\Router;

// Chargement automatique des classes via Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Inclure les fonctions utilitaires
require_once __DIR__ . '/../src/helpers.php';

// Définition du chemin vers le dossier des vues
define('VIEWS', __DIR__ . '/../src/Views/');

// Fonction pour vérifier si le fichier demandé existe dans le dossier public
function isStaticFile($path)
{
    return file_exists(__DIR__ . '/' . $path);
}

// Si le chemin demandé correspond à un fichier statique, le servir directement
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (isStaticFile($requestUri)) {
    return false;
}

// Création d'une instance du routeur avec l'URL demandée
$router = new \App\Core\Router($_GET['url'] ?? '/');


// Définition des routes
$router->get('/', 'HomeController@index');
$router->get('/404', 'ErrorController@notFound');

// Exécution du routeur pour traiter la requête
$router->run();