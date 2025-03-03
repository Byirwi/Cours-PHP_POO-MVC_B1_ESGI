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

    public function findRandom() ?hero
    $stmt = $this->pdo->query('SELECT * FROM hero ORDER BY RAND() LIMIT 1');
    $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
        return new Hero($data['name'], $data['health'], $data['attack_power'], $data['mana'], $data['endurance']);
    }
    return null;

    public function find($id): ?Hero {
        $stmt = $this->pdo->prepare('SELECT * FROM hero WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Hero($data['name'], $data['health'], $data['attack_power'], $data['mana'], $data['endurance']);
        }
        return null;
    }
}