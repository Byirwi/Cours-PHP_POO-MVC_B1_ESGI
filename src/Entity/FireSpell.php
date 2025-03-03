<?php
namespace App\Entity;

final class FireSpell extends Spell {
    public function __construct(string $name, int $manaCost, int $damage) {
        parent::__construct($name, $manaCost, $damage);
    }

    public function cast(Hero $caster, Character $target): string {
        if ($caster->getMana() < $this->manaCost) {
            return 'Pas assez de mana pour lancer le sort.';
        }
        // Déduire le mana du héros
        $caster->decreaseMana($this->manaCost);
        $target->setHealth($target->getHealth() - $this->damage);

        return $caster->getName() . ' lance un sort de feu et inflige ' . $this->damage . ' points de dégâts à ' . $target->getName() . '.';
    }
}