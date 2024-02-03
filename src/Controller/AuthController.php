<?php

namespace App\Controller;

use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Router\Router;
use iFrame\Singleton\DatabaseSingleton;

class AuthController extends AbstractController
{
    public function login(): string
    {
        if(empty($_POST["email"]) && empty($_POST["password"])) {
            return $this->renderView('auth/login.php', [
                'title' => 'Se connecter',
                'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
            ]);
        }


        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";

        $requete = $this->em->getConnexion()->prepare($query);
        $requete->execute(["email" => $_POST["email"]]);
        $tab = $requete->fetchAll();

        if(empty($tab)) {
            return $this->renderView('auth/login.php', [
                'title' => 'Se connecter',
                'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
                'error_message' => 'Le compte n\'existe pas.'
            ]);
        }

        $usr_db = $tab[0];

        if (password_verify($_POST["password"], $usr_db['password'])) {
            $_SESSION['login'] = $_POST['email'];

            return $this->redirectToRoute('app_home');
        }

        return $this->renderView('auth/login.php', [
            'title' => 'Se connecter',
            'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
            'error_message' => 'Le mot de passe est incorrect.'
        ]);

    }

    public function register(): string
    {
        if(empty($_POST["email"]) && empty($_POST["password"])) {
            return $this->renderView('auth/register.php', [
                'title' => 'S\'inscrire',
                'content' => 'Veuillez créer vos identifiants.',
            ]);
        }

        $query = "SELECT * FROM \"user\" WHERE email = :email LIMIT 1;";

        $requete = $this->em->getConnexion()->prepare($query);
        $requete->execute(["email" => $_POST["email"]]);
        $tab = $requete->fetchAll();

        if(empty($tab) === false) {
            return $this->renderView('auth/register.php', [
                'title' => 'S\'inscrire',
                'content' => 'Veuillez créer vos identifiants.',
                'error_message' => 'Un compte existe déjà avec cet email.'
            ]);
        }

        if($_POST["password"] !== $_POST["confirm_password"]) {
            return $this->renderView('auth/register.php', [
                'title' => 'S\'inscrire',
                'content' => 'Veuillez créer vos identifiants.',
                'error_message' => 'Les mots de passe ne correspondent pas.'
            ]);
        }

        $hashPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $query = "INSERT INTO \"user\" (\"email\", \"password\",\"name\") VALUES (:email, :password, :name);";
        $requete = $this->em->getConnexion()->prepare($query);
        $requete->execute(["email" => $_POST["email"], "password"  => $hashPassword, "name" => "toto"]);

        $_SESSION['login'] = $_POST['email'];

        return $this->redirectToRoute('app_home');

    }

    public function logout(): string
    {
        session_unset();

        session_destroy();

        return $this->redirectToRoute('app_login');
    }
}
