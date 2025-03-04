<?php
namespace App\Repository;

use App\Entity\Hero;
use App\Core\Database;
use PDO;

class HeroRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function findRandom(): ?Hero{
        $stmt = $this->pdo->query('SELECT * FROM heroes ORDER BY RAND() LIMIT 1');
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Hero($data['name'], $data['health'], $data['attack_power'], $data['mana'], $data['endurance']);
        }
        return null;
    }

    public function find($id): ?Hero {
        $stmt = $this->pdo->prepare('SELECT * FROM heroes WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Hero($data['name'], $data['health'], $data['attack_power'], $data['mana'], $data['endurance']);
        }
        return null;
    }

    public function save(Hero $hero): bool {
        $stmt = $this->pdo->prepare('INSERT INTO heroes (name, health, attack_power, mana, endurance) VALUES (:name, :health, :attack_power, :mana, :endurance)');
        $stmt->execute([
            'name' => $hero->getName(),
            'health' => $hero->getHealth(),
            'attack_power' => $hero->getAttackPower(),
            'mana' => $hero->getMana(),
            'endurance' => $hero->getEndurance()
        ]);
    }
}