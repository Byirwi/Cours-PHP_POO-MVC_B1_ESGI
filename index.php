<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Router;

// Instanciation du routeur
$router = new Router();

// Définition des routes
$router->get('/', 'App\Controller\GameController::home');
$router->get('/combat', 'App\Controller\GameController::combat');

// Démarrage du routeur
$router->run();