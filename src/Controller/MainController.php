<?php

namespace App\Controller;

class MainController extends Controller
{
    public function home(): string
    {
        return $this->view('main/home.php', ['title' => 'Accueil']);
    }

    public function contact(): void
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        $this->redirect('home', ['state' => 'success']);
    }
}
