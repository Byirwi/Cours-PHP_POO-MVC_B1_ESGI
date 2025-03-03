<?php
namespace App\Core;

class Controller {

    protected function render(string $view, array $params = []): void {
        // Extraction des variables pour les rendre directement accessibles dans la vue
        extract($params);
        // Inclut le fichier de vue situé dans le dossier /src/View/
        require __DIR__ . '/../View/' . $view;
    }
}
