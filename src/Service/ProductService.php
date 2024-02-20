<?php

namespace App\Service;

class ProductService
{
    public function calculateTotalProductInBasket(): void
    {
        $total = 0;

        if(isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $quantity) {
                $total += $quantity;
            }
        }

        $_SESSION['totalProductInBasket'] = $total;
    }
}
