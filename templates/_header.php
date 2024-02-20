<?php

use iFrame\Router\Router;
?>
<header>
<nav class="fixed top-0 left-0 z-10 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
<div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <a href="" class="flex ml-2 md:mr-24">
          <img src="assets/logo3iframe.png" class="h-8 mr-3"/>
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">3iFrame</span>
        </a>

      </div>
    <div class="flex items-center">
        <svg id="basket" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>

        <?php if (isset($_SESSION['totalProductInBasket']) && $_SESSION['totalProductInBasket'] > 0) : ?>
            <div class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900"> <?= $_SESSION['totalProductInBasket'] ?> </div>
        <?php endif; ?>

          <!-- Profile -->
          <div class="flex flex-col items-center ml-3 static">
            <div id="button-dropdown-profile">
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"  aria-expanded="false" data-dropdown-toggle="dropdown-2">
                <span class="sr-only">Open user menu</span>
                <?php if(isset($_SESSION["login"]) && isset($data['user'])) {?>
                  <img class="w-8 h-8 rounded-full" src=<?= $data['user']->getImage() ?> alt="user photo" id="button-dropdown-profile">
                  <?php } else{ ?>
                    <img class="w-8 h-8 rounded-full"  alt="user photo" id="button-dropdown-profile">
                    <?php }?>
              </button>
            </div>
            <!-- Dropdown menu -->
            <div class="absolute right-0 mt-10 z-10 hidden  text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-profile">
            <?php if(isset($_SESSION["login"])) {?>
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                <?php if(isset($data['user'])) $data['user']->getFirstName()?>
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                <?php if(isset($data['user'])) $data['user']->getEmail() ?>
                </p>
              </div>
              <ul class="py-1" role="none">

                <li>
                  <a href="<?=  Router::generate("app_profile") ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                </li>
                <li>
                  <a href="<?=  Router::generate("app_logout") ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Se déconnecter</a>
                </li>
                <li>
                </li>
              </ul>
              <?php }else {?>
                <ul class="py-1 px-4" role="none">
                <li>
                  <a href="<?=  Router::generate("app_login") ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Se connecter</a>
                </li>
                </ul>
                <?php } ?>

            </div>
          </div>
        </div>
    </div>
  </div>
</nav>
</header>
