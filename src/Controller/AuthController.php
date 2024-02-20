<?php

namespace App\Controller;

use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Entity\RedirectResponse;
use iFrame\Entity\Response;

class AuthController extends AbstractController
{
    public function login(): Response
    {
        if(empty($_POST["email"]) && empty($_POST["password"])) {
            return $this->renderView('auth/login.php', [
                'title' => 'Se connecter',
                'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
            ]);
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $_POST['email']]);

        if($user instanceof User) {

            if (password_verify($_POST["password"], $user->getPassword())) {
                $_SESSION['login'] = $_POST['email'];
                return $this->redirectToRoute('app_product');
            }

            return $this->renderView('auth/login.php', [
                'title' => 'Se connecter',
                'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
                'error_message' => 'Le mot de passe est incorrect.'
            ]);
        }

        return $this->renderView('auth/login.php', [
            'title' => 'Se connecter',
            'content' => 'Veuillez saisir votre identifiant et mot de passe pour se connecter.',
            'error_message' => 'Le compte n\'existe pas.'
        ]);

    }

    public function register(): Response
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
        $query = "INSERT INTO \"user\" (\"email\", \"password\",\"firstname\",\"lastname\",\"role\") VALUES (:email, :password, :firstname, :lastname, :role);";
        $requete = $this->em->getConnexion()->prepare($query);
        $requete->execute(["email" => $_POST["email"], "password"  => $hashPassword, "firstname" => $_POST["firstname"], "lastname" => $_POST["lastname"], "role" => "customer"]);

        $_SESSION['login'] = $_POST['email'];

        return $this->redirectToRoute('app_product');

    }

    public function logout(): RedirectResponse
    {
        session_unset();

        session_destroy();

        return $this->redirectToRoute('app_login');
    }
}
