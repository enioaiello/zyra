<?php
namespace App\Core;

class BaseController {
    protected function display(string $view, array $params = []) {
        $viewPath = VIEWS . $view . '.php';

        if (!file_exists($viewPath)) {
            die("La vue '$view' est introuvable.");
        }

        extract($params); // Transforme le tableau en variables PHP

        var_dump(__DIR__);

        // Inclure le fichier de header
        require __DIR__ . '../../../includes/header.inc.php';

        // Inclure le fichier de vue
        require $viewPath;

        // Inclure le fichier de footer
        require __DIR__ . '../../../includes/footer.inc.php';
    }
}
