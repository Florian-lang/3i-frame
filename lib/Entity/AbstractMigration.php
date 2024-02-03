<?php

namespace iFrame\Entity;

use iFrame\Singleton\DatabaseSingleton;

abstract class AbstractMigration extends BaseEntity
{
    protected function addSql(string $sql): void
    {
        $connexion = DatabaseSingleton::getInstance()->getConnection();
        $connexion->exec($sql);
    }

    public function up(): void
    {
        // NO-OP
    }

    public function down(): void
    {
        // NO-OP
    }
}
