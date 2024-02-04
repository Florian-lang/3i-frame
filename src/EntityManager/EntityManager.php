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
        $repository = $className . 'Repository.php';

        if (!file_exists($repository)) {
            return new BaseRepository($className);
        }

        /**
         * @var BaseRepository
         */
        $customRepository = new $repository($className);

        return $customRepository;
    }

    public function getConnexion(): PDO
    {
        return $this->connexion;
    }
}
