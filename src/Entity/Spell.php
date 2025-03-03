<?php
namespace App\Entity;

abstract class Spell {
    protected $name;
    protected $manaCost;
    protected $damage;
    
    public function __construct(string $name, int $manaCost, int $damage) {
        $this->name = $name;
        $this->manaCost = $manaCost;
        $this->damage = $damage;
    }
    
    // Méthode abstraite à implémenter par chaque sort concret
    abstract public function cast(Hero $caster, Character $target): string;
    
    // Getter pour le nom du sort
    public function getName(): string {
        return $this->name;
    }
}