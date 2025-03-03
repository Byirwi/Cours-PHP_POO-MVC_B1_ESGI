<?php
namespace App\Core;

use PDO;

class Database {
    private static $connection = null;
    
    public static function getConnection(): PDO {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config/config.php';
            $db = $config['db'];
            $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset={$db['charset']}";
            self::$connection = new PDO($dsn, $db['user'], $db['password']);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
}