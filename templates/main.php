<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Chargement des ressources -->
     
		<script src="https://cdn.tailwindcss.com"></script>
		<script src="../assets/js/app.js"></script>
		<title> <?= $data['title'] ?> </title>
	</head>
	<body>
		<?php if(isset($_SESSION["login"])){ 
		 include_once __DIR__."/_header.php";  
		 include_once __DIR__."/_sidebar.php";
		}?>
		<main>
			<?php require_once $templatePath ?>
		</main>
	</body>
</html>
