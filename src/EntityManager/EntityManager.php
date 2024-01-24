<?php

namespace App\EntityManager;

use iFrame\EntityManager\AbstractEntityManager;
use PDOStatement;

class EntityManager extends AbstractEntityManager
{
    public function find(string $className, int $id): mixed
    {
        return $this->readOne($className, [ 'id' => $id ]);
    }

    /**
     * @param array<mixed> $filters
     */
    public function findOneBy(string $className, array $filters): mixed
    {
        return $this->readOne($className, $filters);
    }

    public function findAll(string $className): mixed
    {
        return $this->readMany($className);
    }

    /**
     * @param array<mixed> $filters
     * @param array<mixed> $orders
     */
    public function findBy(string $className, array $filters, array $orders = [], int $limit = null, int $offset = null): mixed
    {
        return $this->readMany($className, $filters, $orders, $limit, $offset);
    }

    /**
     * @param array<string, mixed> $classData
     */
    public function add(string $className, array $classData): PDOStatement
    {
        return $this->create($className, $classData);
    }


    /**
     * @param array<string, mixed> $classData
     */
    public function edit(string $className, int $id, array $classData): PDOStatement
    {
        return $this->update($className, $classData, $id);
    }

    public function delete(string $className, int $id): PDOStatement
    {
        return $this->remove($className, $id);
    }
}
