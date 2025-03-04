<?php
namespace App\Repository;

use App\Entity\Boss;
use App\Core\Database;
use PDO;

class BossRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function findRandom(): ?Boss {
        $stmt = $this->pdo->query('SELECT * FROM 	bosses ORDER BY RAND() LIMIT 1');
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Boss($data['name'], $data['health'], $data['attackPower']);
        }
        return null;
    }

    public function find($id): ?Boss {
        $stmt = $this->pdo->prepare('SELECT * FROM 	bosses WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Boss($data['name'], $data['health'], $data['attackPower']);
        }
        return null;
    }

    public function save(boss $boss): bool {
        $stmt = $this->pdo->prepare('INSERT INTO 	bosses (name, health, attackPower) VALUES (:name, :health, :attack_power)');
        return $stmt->execute([
            'name' => $boss->getName(),
            'health' => $boss->getHealth(),
            'attack_power' => $boss->getAttackPower()
        ]);
    }
}