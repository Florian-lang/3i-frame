<?php

namespace App\Command;

use iFrame\Singleton\DatabaseSingleton;

require_once 'lib/autoload.php';

echo "Starting the migration...\n";

$folder = 'migrations/';

$data = scandir($folder);

if(!is_array($data)) {
    echo "No migrations to run.\n";
    exit;
}

$migrationFiles = array_values(array_filter($data, function ($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'php';
}));

if (isset($argv[1]) && $argv[1] === 'setup') {
    setUpMigrations();
    exit;
}

if (isset($argv[1]) && $argv[1] === 'prev') {
    rollbackMigration();
    exit;
}

$sql = DatabaseSingleton::getInstance()
    ->getConnection()
    ->query('SELECT * FROM migration')
;

if(!$sql instanceof \PDOStatement) {
    echo "No migrations to run.\n";
    exit;
}

$migrationsDone = $sql->fetchAll(\PDO::FETCH_ASSOC);

if (!runMigration($migrationFiles, $migrationsDone)) {
    echo "No migrations to run.\n";
}

echo "Migration completed successfully.\n";

function rollbackMigration(): void
{
    $sql = DatabaseSingleton::getInstance()
        ->getConnection()
        ->query('SELECT * FROM migration ORDER BY id DESC LIMIT 1')
    ;

    if(!$sql instanceof \PDOStatement) {
        echo "No migrations to revert.\n";
        exit;
    }

    $lastMigrationDone = $sql->fetch(\PDO::FETCH_ASSOC);

    if ($lastMigrationDone !== null && is_array($lastMigrationDone)) {
        $migrationName = $lastMigrationDone['name'];

        $migrationWithNamespace = "iFrameMigrations\\$migrationName";
        $migration = new $migrationWithNamespace();

        if(!$migration instanceof \iFrame\Entity\AbstractMigration) {
            echo "Migration $migrationName not found.\n";
            exit;
        }

        echo "Reverting $migrationName...\n";
        $migration->down();
        DatabaseSingleton::getInstance()
            ->getConnection()
            ->exec("DELETE FROM migration WHERE name = '$migrationName'")
        ;

        echo "Migration $migrationName reverted successfully.\n";
    } else {
        echo "No migrations to revert.\n";
    }
}

/**
 * @param array<string> $migrationFiles
 * @param array<int, array<string, string>> $migrationsDone
 */
function runMigration(array $migrationFiles, array $migrationsDone): bool
{
    $hasMigrations = false;
    foreach ($migrationFiles as $migrationFile) {
        $migrationName =  pathinfo($migrationFile, PATHINFO_FILENAME);

        $migrationWithNamespace = "iFrameMigrations\\$migrationName";
        $migration = new $migrationWithNamespace();

        if(!$migration instanceof \iFrame\Entity\AbstractMigration) {
            echo "Migration $migrationName not found.\n";
            exit;
        }

        if (!in_array($migrationName, array_column($migrationsDone, 'name'))) {
            $hasMigrations = true;
            echo "Migrating $migrationName...\n";
            $migration->up();
            DatabaseSingleton::getInstance()
                ->getConnection()
                ->exec("INSERT INTO migration (name) VALUES ('$migrationName')")
            ;
        }
    }

    return $hasMigrations;
}

function setUpMigrations(): void
{
    $sql = DatabaseSingleton::getInstance()
        ->getConnection()
        ->query(
            'CREATE TABLE public.migration (
            id serial4 NOT NULL,
            "name" varchar(255) NOT NULL,
            CONSTRAINT migration_pkey PRIMARY KEY (id))'
        )
    ;

    if(!$sql instanceof \PDOStatement) {
        echo "Error setting up migrations.\n";
        exit;
    }

    echo "Migrations set up successfully.\n";
}
