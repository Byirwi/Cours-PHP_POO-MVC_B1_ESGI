<?php
namespace App\Entity;

use App\Entity\Character;

class Boss extends Character {
    // Attaque spéciale : double les dégâts
    public function attack(Character $target): string {
        $damage = $this->attackPower * 2;
        $target->setHealth($target->getHealth() - $damage);

        return $this->name . ' attaque ' . $target->getName() . ' et lui inflige ' . $damage . ' points de dégâts !';
    }
}
