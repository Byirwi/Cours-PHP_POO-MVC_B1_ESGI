<?php
namespace App\Entity;

class ManaFlask implements Consumable {
    private $manaAmount;
    
    public function __construct(int $manaAmount = 30) {
        $this->manaAmount = $manaAmount;
    }
    
    public function useItem(Hero $target): string {
        $target->increaseMana($this->manaAmount);
        return 'Le héro a utilisé une Mana Flask et a récupéré ' . $this->manaAmount . ' points de mana.';
    }
}