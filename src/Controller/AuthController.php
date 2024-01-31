<?php

namespace App\Controller;

use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Singleton\DatabaseSingleton;

class AuthController extends AbstractController
{
    public function login()
    {
        if(empty($_POST["email"]) && empty($_POST["password"]))
        {
            return $this->renderView('auth/login.blade.php', [
                'title' => 'Se connecter',
                'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
            ]);
        }
        
        
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $requete = $this->em->getConnexion()->prepare($query);
        $requete->execute(["email" => $_POST["email"]]);
        $tab = $requete->fetchAll();

        if(empty($tab))
        {
            return $this->renderView('auth/login.blade.php', [
                'title' => 'Se connecter',
                'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
                'error_message' => 'Le compte n\'existe pas.' 
            ]);
        }

        $usr_db = $tab[0];

        if (password_verify($_POST["password"], $usr_db['password'])) {
            //TODO : CREER UNE SESSION
            var_dump('ggg on crée ta session');
            exit;
        }
        return $this->renderView('auth/login.blade.php', [
            'title' => 'Se connecter',
            'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
            'error_message' => 'Le mot de passe est incorrect.' 
        ]);
        
    }
}
