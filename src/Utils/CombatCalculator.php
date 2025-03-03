<?php
namespace App\Utils;

class CombatCalculator {
    public static function calculateDamage(int $baseDamage, int $weaponBonus = 0, float $criticalChance = 0.2): array {
        $totalDamage = $baseDamage + $weaponBonus;
        $isCritical = false;
        // Tirage aléatoire pour le coup critique
        if (mt_rand(0, 100) / 100 < $criticalChance) {
            $totalDamage *= 2;
            $isCritical = true;
        }
        return [
            'damage'   => $totalDamage,
            'critical' => $isCritical
        ];
    }
}