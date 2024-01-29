<?php

namespace App\Repository;

use iFrame\Repository\AbstractRepository;
use PDOStatement;

class BaseRepository extends AbstractRepository
{
    public function __construct(
        private string $className
    ) {
    }

    public function find(int $id): mixed
    {
        return $this->readOne($this->className, [ 'id' => $id ]);
    }

    /**
     * @param array<mixed> $filters
     */
    public function findOneBy(array $filters): mixed
    {
        return $this->readOne($this->className, $filters);
    }

    public function findAll(): mixed
    {
        return $this->readMany($this->className);
    }

    /**
     * @param array<mixed> $filters
     * @param array<mixed> $orders
     */
    public function findBy(array $filters, array $orders = [], int $limit = null, int $offset = null): mixed
    {
        return $this->readMany($this->className, $filters, $orders, $limit, $offset);
    }

    /**
     * @param array<string, mixed> $classData
     */
    public function add(array $classData): PDOStatement
    {
        return $this->create($this->className, $classData);
    }


    /**
     * @param array<string, mixed> $classData
     */
    public function edit(int $id, array $classData): PDOStatement
    {
        return $this->update($this->className, $classData, $id);
    }

    public function delete(int $id): PDOStatement
    {
        return $this->remove($this->className, $id);
    }
}
