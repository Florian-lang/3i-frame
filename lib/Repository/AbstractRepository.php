<?php

namespace iFrame\Repository;

use iFrame\Singleton\DatabaseSingleton;

abstract class AbstractRepository
{
    private function connect(): \PDO
    {
        $databaseInstance = DatabaseSingleton::getInstance();
        $connexion = $databaseInstance->getConnection();

        $connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $connexion;
    }

    /**
     * @param array<mixed> $params
     */
    private function executeQuery(string $query, array $params = []): \PDOStatement
    {
        $db = $this->connect();
        $stmt = $db->prepare($query);

        foreach($params as $key => $param) {
            $stmt->bindValue($key, $param);
        }

        $stmt->execute();

        return $stmt;
    }

    /**
     * @param array<mixed> $filters
     */
    protected function readOne(string $class, array $filters): mixed
    {
        $query = 'SELECT * FROM ' . $this->classToTable($class) . ' WHERE ';

        foreach(array_keys($filters) as $filter) {
            $query .= $filter . " = :" . $filter;

            if($filter != array_key_last($filters)) {
                $query .= ' AND ';
            }
        }
        $stmt = $this->executeQuery($query, $filters);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $class);

        return $stmt->fetch();
    }

    /**
     * @param array<mixed> $filters
     * @param array<mixed> $orders
     */
    protected function readMany(string $class, array $filters = [], array $orders = [], int $limit = null, int $offset = null): mixed
    {
        $query = 'SELECT * FROM ' . $this->classToTable($class);
        if (!empty($filters)) {
            $query .= ' WHERE ';

            foreach (array_keys($filters) as $filter) {
                $query .= $filter . " = :" . $filter;

                if($filter != array_key_last($filters)) {
                    $query .= ' AND ';
                }
            }
        }

        if (!empty($orders)) {
            $query .= ' ORDER BY ';

            foreach ($orders as $key => $val) {
                $query .= $key . ' ' . $val;

                if($key != array_key_last($orders)) {
                    $query .= ', ';
                }
            }
        }

        if (isset($limit)) {
            $query .= ' LIMIT ' . $limit;

            if (isset($offset)) {
                $query .= ' OFFSET ' . $offset;
            }
        }

        $stmt = $this->executeQuery($query, $filters);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $class);

        return $stmt->fetchAll();
    }

    /**
     * @param array<mixed> $fields
     */
    protected function create(string $class, array $fields): \PDOStatement
    {
        $query = "INSERT INTO " . $this->classToTable($class) . " (";

        foreach (array_keys($fields) as $field) {
            $query .= $field;

            if($field != array_key_last($fields)) {
                $query .= ', ';
            }
        }
        $query .= ') VALUES (';

        foreach (array_keys($fields) as $field) {
            $query .= ':' . $field;

            if($field != array_key_last($fields)) {
                $query .= ', ';
            }
        }
        $query .= ')';

        return $this->executeQuery($query, $fields);
    }

    /**
     * @param array<mixed> $fields
     */
    protected function update(string $class, array $fields, int $id): \PDOStatement
    {
        $query = "UPDATE " . $this->classToTable($class) . " SET ";

        foreach (array_keys($fields) as $field) {
            $query .= $field . " = :" . $field;

            if($field != array_key_last($fields)) {
                $query .= ', ';
            }
        }
        $query .= ' WHERE id = :id';
        $fields['id'] = $id;

        return $this->executeQuery($query, $fields);
    }

    protected function remove(string $class, int $id): \PDOStatement
    {
        $query = "DELETE FROM " . $this->classToTable($class) . " WHERE id = :id";

        return $this->executeQuery($query, [ 'id' => $id ]);
    }

    private function classToTable(string $class): string
    {
        $tableName = explode('\\', $class);

        return strtolower(end($tableName));
    }
}
