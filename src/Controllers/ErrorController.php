<?php
namespace App\Controllers;

use App\Core\BaseController;

class ErrorController extends BaseController {
    public function notFound() {
        $this->display('error', ['title' => 'Page introuvable']);
    }
}
