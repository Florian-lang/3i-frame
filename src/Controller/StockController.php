<?php

namespace App\Controller;

use App\Entity\Stock;
use iFrame\Controller\AbstractController;


class StockController extends AbstractController
{
    public function updateStock(): void {
        $productId = $_POST['productId'];
        $newQuantity = $_POST['stock'];
        $this->em->getRepository(Stock::class)->edit($productId,['number'=>$newQuantity]);

        echo $newQuantity;
    }
}