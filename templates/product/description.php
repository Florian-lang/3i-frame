<?php

use iFrame\Router\Router;
?>
<div class="grid grid-cols-1 px-4 mx-4 pt-6 xl:grid-cols-2 xl:gap-4 dark:bg-gray-900 w-full">
    <div class="mb-4 col-span-full xl:mb-2">
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-white">
                        <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Cataloge</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="<?= Router::generate('app_product') ?>" class="ml-1 text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Produits</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page"><?= $data["product"]->getName() ?></span>
                    </div>
                </li>
            </ol>
        </nav>
        <?php $product = $data["product"]; ?>
        <!-- Utilise flex pour aligner les éléments horizontalement -->
        <div class=" w-full flex justify-between items-start">
            <!-- Utilise une classe spécifique pour la zone de détails du produit -->
            <div class="w-full grid grid-cols-2">
                <!-- Photo du produit à gauche -->
                <img class="rounded-t-lg " src="<?= URL_IMAGE . $data["product"]->getImage() ?>" alt="product image" />

                <!-- Détails du produit -->
                <div class="px-5 pb-5 space-y-8">
                    <h1 class="text-4xl font-semibold mb-2 text-gray-900 dark:text-white"><?= $data["product"]->getName() ?></h1>
                    <p class="text-xl font-semibold mb-4 text-black-900 dark:text-white"><?= $data["product"]->getDescription() ?></p>
                    <p class="text-5xl font-semibold mb-4 text-gray-700 dark:text-white"><?= $data["product"]->getPrice() . "€" ?></p>

                    <div class="flex justify-center items-center border-gray-100">
                        <span class="cursor-pointer rounded-l text-4xl bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50" onclick="less()"> - </span>
                        <input class="w-32 py-1 border bg-white text-4xl text-center  outline-none" type="string" value="0" min="0" id="quantity"/>
                        <span class="cursor-pointer rounded-r text-4xl bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50" onclick="more()"> + </span>

                    </div>
                    <button class="flex w-full justify-center items-center gap-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
</svg>
Ajouter au panier
                    </button>

                    

                        <!-- Ajoute ici d'autres détails du produit si nécessaire -->
                </div>


            </div>
            <!-- Ajoute ici la logique pour afficher les détails du produit -->
            <div class="max-w-lg">
                <!-- Détails supplémentaires du produit -->
                <!-- Exemple : Description, catégorie, etc. -->
            </div>
        </div>
    </div>
</div>

<script>
    function less()
    {
        let quantity = document.getElementById('quantity');
        
        if(quantity.value > 0)
        {
            quantity.value--;
        }
    }
    function more()
    {
        let quantity = document.getElementById('quantity');
        quantity.value++
        
    }
</script>