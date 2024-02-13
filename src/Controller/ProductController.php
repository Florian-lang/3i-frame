<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Entity\RedirectResponse;
use iFrame\Entity\Response;

class ProductController extends AbstractController
{
    public function home(): Response{
        $products = $this->em->getRepository(Product::class)->findAll();

        return $this->renderView('product/home.php', [
            'title' => 'Accueil',
            'content' => 'Je suis le contenu de la page',
            'products' => $products
        ]);
    }

    public function createProduct(): Response{
        if(empty($_POST["name"])) {
            return $this->renderView('product/create.php', [
                'title' => 'Créer un produit',
                'content' => 'Vous pouvez ajouter un nouveau produit',
            ]);
        }
               
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmpFilePath = $_FILES['image']['tmp_name'];

            $newFilePath = './assets/images_upload/products/' . basename($_FILES['image']['name']);
            move_uploaded_file($tmpFilePath, $newFilePath);               
            
        }
       
        $this->em->getRepository(Product::class)->add([
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "price" => $_POST['price'],
            "category_id" => $_POST['category_id'] === "" ? null : $_POST['category_id'],
            "image" => $newFilePath ?? null,

        ]);

        return $this->redirectToRoute('app_product');  

    }

    public function description(): Response{
        $product = $this->em->getRepository(Product::class)->find($_GET['id']);

        if($product instanceof Product)
        {
            return $this->renderView('product/description.php', [
                'title' => 'Accueil',
                'content' => 'Je suis le contenu de la page',
                'product' => $product
            ]);
        }
        
        return $this->redirectToRoute('app_error_404');
    }

}
