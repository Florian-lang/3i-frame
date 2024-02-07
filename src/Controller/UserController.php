<?php

namespace App\Controller;

use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Entity\RedirectResponse;
use iFrame\Entity\Response;

class UserController extends AbstractController
{
    public function profile(): Response
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $_SESSION['login']]);

        if($user instanceof User) {
            return $this->renderView('main/profile.php', [
                'title' => 'Mon profil',
                'content' => 'Yoyoyoy',
                'user' => $user
            ]);
        }

        return $this->redirectToRoute('app_error_404');
    }

    public function inputProfile(): RedirectResponse
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $_SESSION['login']]);
        if($user instanceof User) {                     
            $this->em->getRepository(User::class)->edit($user->getId(), [
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "city" => $_POST['city'],
                "address" => $_POST['address'],
                "country" => $_POST['country'],
                "postal_code" => $_POST['postal_code'],
                "phone" =>  $_POST['phone'],
            ]);

        }
        return $this->redirectToRoute('app_profile');  
    }

    public function inputImage(): RedirectResponse
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $_SESSION['login']]);
        if($user instanceof User) {         
            // Vérifiez si le fichier a été correctement téléchargé
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Obtenez le chemin temporaire du fichier téléchargé
                $tmpFilePath = $_FILES['image']['tmp_name'];

                // Déplacez le fichier vers l'emplacement souhaité (par exemple, le répertoire des images de profil)
                $newFilePath = './assets/images_upload/' . basename($_FILES['image']['name']);
                move_uploaded_file($tmpFilePath, $newFilePath);               
                // Mettez à jour le chemin de l'image dans l'entité User
                $this->em->getRepository(User::class)->edit($user->getId(), ["image" => $newFilePath]);
                $user->setImage($newFilePath);
            }
           
        }

        return $this->redirectToRoute('app_profile');  
    }

    public function inputPassword(): RedirectResponse
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $_SESSION['login']]);
        if($user instanceof User) {       
            if($_POST["new_password"] === $_POST["confirm_password"] && password_verify($_POST["current_password"], $user->getPassword()))
            {
                $this->em->getRepository(User::class)->edit($user->getId(), [
                    "password" => password_hash($_POST["new_password"], PASSWORD_DEFAULT),
                ]);
            }              
        }
        return $this->redirectToRoute('app_profile');  
    }
}
