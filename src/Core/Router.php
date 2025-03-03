<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function get($path, $controllerAction) {
        $this->routes['GET'][$path] = $controllerAction;
    }
    
    public function post($path, $controllerAction) {
        $this->routes['POST'][$path] = $controllerAction;
    }
    
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
        // Définit la base de notre application
        $base = '/Tp_Elden_Ring_V2';
        
        // Retire la base si présente
        if (strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }
        
        // Si l'URI est vide ou égale à "/index.php", le définir comme "/"
        if ($uri === '' || $uri === '/index.php') {
            $uri = '/';
        }
    
        if (isset($this->routes[$method][$uri])) {
            $controllerAction = $this->routes[$method][$uri];
            list($controller, $action) = explode('::', $controllerAction);
            if (class_exists($controller) && method_exists($controller, $action)) {
                $instance = new $controller;
                call_user_func([$instance, $action]);
            } else {
                http_response_code(404);
                echo "Controller or action not found!";
            }
        } else {
            http_response_code(404);
            echo "Route not defined!";
        }
    }    
}
