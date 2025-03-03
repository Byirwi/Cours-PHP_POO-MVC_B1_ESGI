<?php
namespace App\Entity;

class Weapon {
    private $name;
    private $damageBonus;
    
    public function __construct(string $name, int $damageBonus) {
        $this->name = $name;
        $this->damageBonus = $damageBonus;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getDamageBonus(): int {
        return $this->damageBonus;
    }
}