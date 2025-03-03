<?php
namespace App\Service;

use App\Entity\Hero;
use App\Entity\Boss;
use App\Entity\FireSpell;
use App\Entity\EstusFlask;
use App\Entity\ManaFlask;
use App\Entity\Weapon;
use App\Repository\HeroRepository;
use App\Repository\BossRepository;

class CombatService {
    public function startCombat(): array {
        $heroRepo = new HeroRepository();
        $bossRepo = new BossRepository();
        
        // Sélection aléatoire du héros et du boss depuis la base de données
        $hero = $heroRepo->findRandom();
        if (!$hero) {
            // Cas par défaut si aucune donnée n'est trouvée
            $hero = new Hero("Chevalier Errant", 150, 25, 100, 100);
        }
        $boss = $bossRepo->findRandom();
        if (!$boss) {
            $boss = new Boss("Seigneur des Ténèbres", 200, 30);
        }
        
        // Nombre aléatoire de fioles (entre 0 et 2)
        $numEstus = rand(0, 2);
        $numMana  = rand(0, 2);
        
        $result = [];
        $result[] = "Le combat commence entre {$hero->getName()} et {$boss->getName()}.";
        $result[] = "{$hero->getName()} dispose de {$numEstus} fiole(s) d'Estus et {$numMana} fiole(s) de mana.";

        // 40% de chance d'équiper une arme au Héros
        if (rand(1, 100) <= 40) {
            $weapon = new Weapon("Epée Légendaire", 25);
            $result[] = $hero->equipWeapon($weapon);
        }

        $result[] = "Statuts initiaux :";
        $result[] = "{$boss->getName()} - Vie: {$boss->getHealth()}";
        $result[] = "{$hero->getName()} - Vie: {$hero->getHealth()}, Mana: {$hero->getMana()}, Endurance: {$hero->getEndurance()}";
        
        $turn = 1;
        while ($hero->getHealth() > 0 && $boss->getHealth() > 0) {
            $result[] = "=== Tour {$turn} ===";
            // Affichage des statuts au début du tour
            $result[] = "[Début du tour] {$hero->getName()} - Vie: {$hero->getHealth()}, Mana: {$hero->getMana()}, Endurance: {$hero->getEndurance()} | {$boss->getName()} - Vie: {$boss->getHealth()}";
            
            // Phase du héros
            $heroActions = [];
            
            // 1. Soins si nécessaire (PV < 80) et s'il reste des fioles d'Estus
            if ($hero->getHealth() < 80 && $numEstus > 0) {
                $estus = new EstusFlask(50); // Régénère 50 PV
                $msg = $estus->useItem($hero);
                $numEstus--;
                $heroActions[] = "[Soins] " . $msg;
                $heroActions[] = "{$hero->getName()} a maintenant {$hero->getHealth()} PV.";
            }
            
            // 2. Régénération de mana si nécessaire (mana < 20) et s'il reste des fioles de mana
            if ($hero->getMana() < 20 && $numMana > 0) {
                $manaFlask = new ManaFlask(30); // Régénère 30 mana
                $msg = $manaFlask->useItem($hero);
                $numMana--;
                $heroActions[] = "[Mana] " . $msg;
                $heroActions[] = "{$hero->getName()} a maintenant {$hero->getMana()} mana.";
            }
            
            // 3. Action principale du héros
            $actionType = rand(0, 1); // 0 = attaque physique, 1 = lancer un sort
            if ($actionType === 1) {
                $fireSpell = new FireSpell("Boule de Feu", 20, 40); // Coût: 20 mana, Dégâts: 40
                $msg = $fireSpell->cast($hero, $boss);
                $heroActions[] = "[Sort] " . $msg;
            } else {
                $msg = $hero->attack($boss);
                $heroActions[] = "[Attaque] " . $msg;
            }
            $heroActions[] = "Après l'action du héros, {$boss->getName()} a {$boss->getHealth()} PV.";
            $result = array_merge($result, $heroActions);
            
            // Vérification de la victoire du boss
            if ($boss->getHealth() <= 0) {
                $result[] = "{$boss->getName()} est vaincu !";
                break;
            }
            
            // Phase du boss
            $bossMsg = $boss->attack($hero);
            $result[] = "[Boss] " . $bossMsg;
            $result[] = "Après l'action du boss, {$hero->getName()} a {$hero->getHealth()} PV.";
            
            // Vérification de la victoire du héros
            if ($hero->getHealth() <= 0) {
                $result[] = "{$hero->getName()} est vaincu !";
                break;
            }
            
            // Fin du tour: récapitulatif des statuts mis à jour
            $result[] = "[Fin du tour {$turn}] {$hero->getName()} - Vie: {$hero->getHealth()}, Mana: {$hero->getMana()}, Endurance: {$hero->getEndurance()} | {$boss->getName()} - Vie: {$boss->getHealth()}";
            
            $turn++;
        }
        
        return $result;
    }
}