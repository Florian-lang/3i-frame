<?php

namespace App\Controller;

use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Entity\Response;

class ProductController extends AbstractController
{
    public function home(): Response{
        return $this->renderView('product/home.php', [
            'title' => 'Accueil',
            'content' => 'Je suis le contenu de la page',
        ]);
    }

}