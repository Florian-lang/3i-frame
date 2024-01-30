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
            return $this->renderView('auth/login.php', [
                'title' => 'Erreur 404',
                'content' => 'Aïe... Nous n\'avons pas trouvé la page.',
            ]);
        }
        
        
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $requete = $this->em->getConnexion()->prepare($query);
        $requete->execute(["email" => $_POST["email"]]);
        $tab = $requete->fetchAll();
        //TODO : Si on a aucun retour, alors le rammener sur le formulaire avec un message d'erreur

        //TODO : Si on a un retour mais que le mot de passe ne correspond pas, le rammener sur le formulaire avec un message d'erreur

        //TODO : Si tout est bon, on le connecte.


        $usr_db = $tab[0];
        //
        if (password_verify($_POST["password"], $tab[0]['password'])) {
            var_dump('ggg');
        }

        
        exit;
        
    }
}
