<?php

namespace iFrameMigrations;

use iFrame\Entity\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207145122 extends AbstractMigration {

    public function up() : void
    {
        $this->addSql("CREATE TABLE \"product\" (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description VARCHAR(255) NOT NULL,
            price VARCHAR(255),
            image VARCHAR(255),
            category_id INT
            );");
    }

    public function down() : void
    {
        $this->addSql("DROP TABLE IF EXIST \"product\";");
    }
}