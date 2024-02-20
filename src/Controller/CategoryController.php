<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Entity\Response;

class CategoryController extends AbstractController
{
    public function home(): Response{
        $categories = $this->em->getRepository(Category::class)->findAll();
        $user = isset($_SESSION['login']) ? $this->em->getRepository(User::class)->findOneBy(['email' => $_SESSION['login']]) : null;

        return $this->renderView('category/home.php', [
            'title' => 'Accueil',
            'content' => 'Je suis le contenu de la page',
            'categories' => $categories,
            'user' => $user
        ]);
    }

    public function createCategory(): Response{
      
        if(empty($_POST["name"])) {
            return $this->renderView('category/create.php', [
                'title' => 'Créer un produit',
                'content' => 'Vous pouvez ajouter un nouveau produit',
            ]);
        }
        
        $this->em->getRepository(Category::class)->add([
            "name" => $_POST['name'],
            "bgColor" => $_POST['bgColor'],
            "textColor" => $_POST['textColor'],
        ]);

        return $this->redirectToRoute('app_category');  
    }
}   