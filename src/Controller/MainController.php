<?php 
namespace App\Controller;

class MainController extends Controller{
    public function home()
    {
        return $this->view('main/home.php', ['title' => 'Accueil']);
    }

    public function contact() {
		// Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
		return $this->redirect('home', ['state' => 'success']);
	}
}