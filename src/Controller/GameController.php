<?php
namespace App\Controller;

use App\Core\Controller
use App\Service\CombatService;

class GameController extends Controller {
    public function home() {
        $this->render('home.php', ['title' => 'Bienvenue dans Elden Ring Game']);
    }

    public function combat() {
        $combatService = new CombatService();
        $result = $combatService->startCombat();
        $this->render('combat.php', ['result' => $result]);
    }
}