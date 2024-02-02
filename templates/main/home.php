<?php use iFrame\Router\Router;?>

<h1 class="text-3xl font-bold underline"> <?= $data['content'] ?> </h1>
<a href="<?=  Router::generate("app_login") ?>">Cliquer</a>
