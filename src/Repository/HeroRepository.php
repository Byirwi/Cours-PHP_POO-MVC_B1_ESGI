<?php
namespace App\Repository;

use App\Entity\Hero;
use App\Core\Database;
use PDO;

class HeroRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getPDO();
    }
}