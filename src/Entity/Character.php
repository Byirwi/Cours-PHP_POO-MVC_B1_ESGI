<?php
namespace App\Entity;

class Character {
    protected $name; // Attribut 1
    protected $health; // Attribut 2
    protected $attackPower; // Attribut 3
    
  	// Constructeur
    public function __construct(string $name, int $health, int $attackPower) {
        $this->name = $name;
        $this->health = $health;
        $this->attackPower = $attackPower;
    }
    
    // Getters
    public function getName(): string { 
        return $this->name; 
    }

    public function getHealth(): int { 
        return $this->health; 
    }

    public function getAttackPower(): int { 
        return $this->attackPower; 
    }
    
  	// Setters
    public function setHealth(int $health): void { 
        $this->health = $health; 
    }

  	// Méthodes
    public function attack(Character $target): string {
        $target->setHealth($target->getHealth() - $this->attackPower);
        return "{$this->name} attaque {$target->getName()} !";
    }

    public function displayStatus(): void {
        echo "{$this->name} - Points de vie: {$this->health}, Attaque: {$this->attackPower}\n";
    }
}