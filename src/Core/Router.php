<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get($path, $controller)
    {
        $this->routes['GET'][$path] = $controller;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $this->url;

        if (isset($this->routes[$method][$path])) {
            $controllerAction = explode('@', $this->routes[$method][$path]);
            $controllerName = 'App\\Controllers\\' . $controllerAction[0];
            $action = $controllerAction[1];

            if (class_exists($controllerName) && method_exists($controllerName, $action)) {
                $controller = new $controllerName();
                $controller->$action();
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }

    private function notFound()
    {
        http_response_code(404);
        require_once VIEWS . 'error.php';
    }
}