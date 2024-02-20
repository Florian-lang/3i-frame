<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Stock;
use App\Entity\User;
use iFrame\Controller\AbstractController;
use iFrame\Entity\Constant;
use iFrame\Entity\Response;

class ProductController extends AbstractController
{
    public function home(): Response
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        return $this->renderView('product/home.php', [
            'title' => 'Accueil',
            'content' => 'Je suis le contenu de la page',
            'products' => $products
        ]);
    }

    public function createProduct(): Response
    {
        if(empty($_POST["name"])) {
            return $this->renderView('product/create.php', [
                'title' => 'Créer un produit',
                'content' => 'Vous pouvez ajouter un nouveau produit',
            ]);
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmpFilePath = $_FILES['image']['tmp_name'];

            $newFilePath = 'products/' . basename($_FILES['image']['name']);
            move_uploaded_file($tmpFilePath, Constant::ASSET_IMAGE.$newFilePath);

        }

        $this->em->getRepository(Product::class)->add([
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "price" => $_POST['price'],
            "category_id" => $_POST['category_id'] === "" ? null : $_POST['category_id'],
            "image" => $newFilePath ?? null,
        ]);

        //TODO : Récupérer l'id de l'objet qu'on a crée sans rappeler la méthode findOneBy

        /**
            * @var Product
        */
        $product = $this->em->getRepository(Product::class)->findOneBy([
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "price" => $_POST['price'],
        ]);
        
        $this->em->getRepository(Stock::class)->add([
            "id" => $product->getId(),
            "number" => $_POST['stock'] ?? 0,
        ]);
        
        return $this->redirectToRoute('app_product');  

    }

    public function description(): Response
    {
        $product = $this->em->getRepository(Product::class)->find($_GET['id']);
        $stock = $this->em->getRepository(Stock::class)->find($_GET['id']);
       
        if($product instanceof Product)
        {
            $user = $this->em->getRepository(User::class)->findOneBy(['email' => $_SESSION['login']]);

            return $this->renderView('product/description.php', [
                'title' => 'Accueil',
                'content' => 'Je suis le contenu de la page',
                'product' => $product,
                'stock' => $stock,
                'user' => $user
            ]);
        }

        return $this->redirectToRoute('app_error_404');
    }

    public function addToBasket(): Response
    {
        $productId = (int) $_POST['productId'];
        $userEmail = (string) $_SESSION['login'];
        $quantity = (int) $_POST['quantity'];

        if($quantity < 1) {
            return new Response('Quantity not valid', Response::HTTP_BAD_REQUEST);
        }

        if($productId === 0) {
            return new Response('Product not found', Response::HTTP_NOT_FOUND);
        }

        if(!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $userEmail]);

        if(!$user instanceof User) {
            return new Response('User not found', Response::HTTP_NOT_FOUND);
        }

        $user->addProductToBasket($productId, $quantity);
        $this->productService->calculateTotalProductInBasket();

        return new Response('Product added to basket', Response::HTTP_OK);
    }

}
