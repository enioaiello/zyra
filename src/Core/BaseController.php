<?php
namespace App\Core;

class BaseController {
    protected function display(string $view, array $params = []) {
        $viewPath = VIEWS . $view . '.php';

        if (!file_exists($viewPath)) {
            die("La vue '$view' est introuvable.");
        }

        extract($params); // Transforme le tableau en variables PHP
        require $viewPath;
    }
}
