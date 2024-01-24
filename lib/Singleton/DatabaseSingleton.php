<?php

namespace iFrame\Singleton;

use PDO;
use PDOException;

class DatabaseSingleton
{
    private static ?self $instance = null;
    private PDO $connection;

    private const DB_INFOS = [
        'host'     => 'localhost',
        'port'     => '15436',
        'dbname'   => 'app',
        'username' => '3i-frame',
        'password' => '3i-frame'
    ];

    private function __construct()
    {
        $this->connect();
    }

    public static function getInstance(): DatabaseSingleton
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseSingleton();
        }

        return self::$instance;
    }

    private function connect(): void
    {
        $dsn = "pgsql:host=" . self::DB_INFOS['host'] . ";port=" . self::DB_INFOS['port'] . ";dbname=" . self::DB_INFOS['dbname'] . ";user=" . self::DB_INFOS['username'] . ";password=" . self::DB_INFOS['password'];

        try {
            $this->connection = new PDO($dsn);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
