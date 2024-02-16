<?php

namespace iFrameMigrations;

use iFrame\Entity\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216210947 extends AbstractMigration {

    public function up() : void
    {
        $this->addSql("CREATE TABLE \"stock\" (
            id INT PRIMARY KEY,
            number INT NOT NULL,
            FOREIGN KEY (id) REFERENCES product(id)
            );");

        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down() : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE \"stock\";");

    }
}