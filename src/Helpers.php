<?php

/*
 * @param string $path Le chemin relatif de la ressource.
 * @return string L'URL absolue de la ressource.
 */

function assets($path) {
    // Assurez-vous que le chemin commence par un slash
    $path = ltrim($path, '/');
    // Retourne l'URL complète
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/public/' . $path;
}