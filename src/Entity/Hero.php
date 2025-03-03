<?php
namespace App\Entity;

use App\Entity\Character;
use App\Utils\CombatCalculator;

class Hero extends Character {
    private $mana;
    private $endurance;
    private $weapon; // Arme équipée, instance de Weapon (optionnelle)

    public function __construct(string $name, int $health, int $attackPower, int $mana = 100, int $endurance = 100) {
        parent::__construct($name, $health, $attackPower);
        $this->mana = $mana;
        $this->endurance = $endurance;
    }
    
    // Getters
    public function getMana(): int {
        return $this->mana;
    }
    
    public function getEndurance(): int {
        return $this->endurance;
    }
    
    // Méthodes de modification
    public function increaseMana(int $amount): void {
        $this->mana += $amount;
    }
    
    public function decreaseMana(int $amount): void {
        $this->mana = max(0, $this->mana - $amount);
    }
    
    public function increaseEndurance(int $amount): void {
        $this->endurance += $amount;
    }
    
    public function decreaseEndurance(int $amount): void {
        $this->endurance = max(0, $this->endurance - $amount);
    }
    
    // Méthode pour équiper une arme
    public function equipWeapon(Weapon $weapon): string {
        $this->weapon = $weapon;
        return "{$this->name} équipe l'arme {$weapon->getName()}, qui rajoute {$weapon->getDamageBonus()} points d'attaque. \n";
    }
    
    // Redéfinition de attack() : vérifie l'endurance
    public function attack(Character $target): string {
        $attackCost = 10;
        if ($this->endurance < $attackCost) {
            return "{$this->name} n'a pas assez d'endurance pour attaquer.";
        }
        $this->decreaseEndurance($attackCost);
        
        $weaponBonus = ($this->weapon) ? $this->weapon->getDamageBonus() : 0;
        
        // Utilisation de la méthode statique pour calculer les dégâts et obtenir l'info de coup critique
        $result = CombatCalculator::calculateDamage($this->attackPower, $weaponBonus);
        $damage = $result['damage'];
        $isCritical = $result['critical'];
        
        $target->setHealth($target->getHealth() - $damage);
        
        $message = "{$this->name} attaque {$target->getName()} et inflige {$damage} points de dégâts.";
        if ($isCritical) {
            $message .= " Coup critique !";
        }
        return $message;
    }
}

$Lolan = new Hero("God of my heart Lolan", 100000000000, 100000000000, 100000000000, 100000000000) // les deux derniere valeur sont reprociquement mana et endurance 
$Liam = new Hero("GOD of Extra-Chromies", 1000000, 1000000, 1000000, 1000000)
$letMeSoloHer = new hero("let me solo her",250, 50, 100, 100) 
