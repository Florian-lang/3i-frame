<?php

namespace App\Controller;

use App\Entity\User;
use iFrame\Controller\AbstractController;

class UserController extends AbstractController
{
    public function profile(): string
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $_SESSION['login']]);

        if($user instanceof User) {
            return $this->renderView('main/profile.php', [
                'title' => 'Mon profil',
                'content' => 'Yoyoyoy',
                'user' => $user
            ]);
        }
        $this->redirectToRoute('app_error_404');
        return "";
    }

    public function inputImage(): string
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
            var_dump('iciii');

        }

        $this->redirectToRoute('app_profile');
        return "";
    }
}
