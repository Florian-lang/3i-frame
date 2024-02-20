<?php

namespace iFrameMigrations;

use iFrame\Entity\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220150538 extends AbstractMigration {

    public function up() : void
    {
        $password = password_hash("admin",PASSWORD_DEFAULT);
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO \"user\" (\"email\", \"password\",\"firstname\",\"lastname\",\"role\") VALUES ('admin@admin.com', '$password', 'admin', 'admin', 'admin');");
    }

    public function down() : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}