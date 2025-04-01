<?php
namespace App\Controllers;

class HomeController {
    public function index() {
        require VIEWS . 'home.php';
    }
}
