<?php

namespace App\Controller;

use App\Entity\User;
use iFrame\Controller\AbstractController;

class MainController extends AbstractController
{
    public function home(): string
    {
        $user = $this->em->getRepository(User::class)->find(2);

        if($user instanceof User) {

        }

        return $this->renderView('main/home.php', [
            'title' => 'Accueil',
            'content' => 'Je suis le contenu de la page',
        ]);
    }

    public function shop(): string
    {
        return $this->renderView('main/home.php', [
            'title' => 'My shop',
            'content' => 'Yoyoyoy',
        ]);
    }

}
