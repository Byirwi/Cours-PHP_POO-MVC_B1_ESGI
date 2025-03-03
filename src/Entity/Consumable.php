<?php
namespace App\Entity;

interface Consumable {
    public function useItem(Hero $target): string;
}
