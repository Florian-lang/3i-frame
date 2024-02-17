<?php

namespace iFrameMigrations;

use iFrame\Entity\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240217005127 extends AbstractMigration {

    public function up() : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE \"category\" (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            bgColor VARCHAR(255),
            textColor VARCHAR(255)
            );");
    }

    public function down() : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DROP TABLE \"category\";");

    }
}