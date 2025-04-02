<?php
namespace App\Controllers;

use App\Core\BaseController;

class HomeController extends BaseController {
    public function index() {
        $this->display('home', ['title' => 'Accueil', 'message' => 'Bienvenue sur mon site MVC !']);
    }

    public function about() {
        $this->display('about', ['title' => 'À propos']);
    }
}
