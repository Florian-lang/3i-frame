<?php use iFrame\Router\Router;?>
<?php include_once __DIR__."/../_header.php";  ?>
<?php include_once __DIR__."/../_sidebar.php";  ?>

<h1 class="text-3xl font-bold underline"> <?= $data['content'] ?> </h1>
<a href="<?=  Router::generate("aaaa") ?>">Cliquer</a>
