<?php

namespace App\Controller;

use iFrame\Controller\AbstractController;

class MainController extends AbstractController
{
    public function home(): string
    {
        return $this->renderView('main/home.php', [
            'title' => 'Accueil',
            'content' => 'Je suis le contenu de la page',
        ]);
    }
}
