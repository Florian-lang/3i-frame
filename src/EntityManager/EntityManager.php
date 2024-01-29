<?php

namespace App\EntityManager;

use App\Repository\BaseRepository;
use iFrame\Singleton\DatabaseSingleton;

class EntityManager
{
    public function __construct(
        private readonly \PDO $connexion = DatabaseSingleton::getInstance()->getConnection()
    ) {
    }

    public function getRepository(string $className): BaseRepository
    {
        return new BaseRepository($className);
    }

    public function getConnexion(): \PDO
    {
        return $this->connexion;
    }
}
