<?php

namespace iFrameMigrations;

use iFrame\Entity\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204154210 extends AbstractMigration {

    public function up() : void
    {
        $query = "CREATE TABLE \"user\" (
            id SERIAL PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            address VARCHAR(255),
            country VARCHAR(255),
            city VARCHAR(255),
            postal_code VARCHAR(20),
            phone VARCHAR(20),
            image VARCHAR(255)
            );";

            $requete = $this->em->getConnexion()->prepare($query);
            $requete->execute();

    }

    public function down() : void
    {   
        $query = "DROP TABLE IF EXIST \"user\";";
        $requete = $this->em->getConnexion()->prepare($query);
        $requete->execute();

    }
}