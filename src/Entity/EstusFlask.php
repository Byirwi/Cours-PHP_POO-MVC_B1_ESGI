<?php
namespace App\Entity;

class EstusFlask implements Consumable {
    private $healAmount;
    
    public function __construct(int $healAmount = 50) {
        $this->healAmount = $healAmount;
    }
    
    public function useItem(Hero $target): string {
        $target->setHealth($target->getHealth() + $this->healAmount);
        return 'Le héro a utilisé une Estus Flask et a récupéré ' . $this->healAmount . ' points de vie.';
    }
}