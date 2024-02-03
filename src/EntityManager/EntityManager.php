<?php

namespace App\EntityManager;

use App\Repository\BaseRepository;
use iFrame\Singleton\DatabaseSingleton;
use PDO;

class EntityManager
{
    private PDO $connexion;

    public function __construct()
    {
        $this->connexion = DatabaseSingleton::getInstance()->getConnection();
    }

    public function getRepository(string $className): BaseRepository
    {
        return new BaseRepository($className);
    }

    public function getConnexion(): PDO
    {
        return $this->connexion;
    }
}
