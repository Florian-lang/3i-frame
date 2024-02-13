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
                        <a href="#" class="ml-1 text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">CRUD</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Produit</span>
                    </div>
                </li>
            </ol>
        </nav>
        <?php $product = $data["product"];?>
        <!-- Utilise flex pour aligner les éléments horizontalement -->
        <div class=" w-full flex justify-between items-start">
            <!-- Utilise une classe spécifique pour la zone de détails du produit -->
            <div class="w-full grid grid-cols-2">
                <!-- Photo du produit à gauche -->
                <img class="rounded-t-lg " src="https://www.laconstructionlyonnaise.fr/wp-content/uploads/2022/11/belle-maison-archi-LCL.jpg" alt="product image" />

                <!-- Détails du produit -->
                <div class="px-5 pb-5">
                    <h1 class="text-4xl font-semibold mb-2 text-gray-900 dark:text-white"><?= $data["product"]->getName() ?></h1>
                    <p class="text-xl font-semibold mb-4 text-black-900 dark:text-white"><?= $data["product"]->getDescription()?></p>
                    <p class="text-5xl font-semibold mb-4 text-gray-700 dark:text-white"><?= $data["product"]->getPrice()."€" ?></p>

                    <div class="flex justify-center items-center border-gray-100">
                <span class="cursor-pointer rounded-l text-4xl bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"> - </span>
                <input class="w-32 py-1 border bg-white text-4xl text-center  outline-none" type="string" value="0" min="0" />
                <span class="cursor-pointer rounded-r text-4xl bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"> + </span>
              </div>
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
