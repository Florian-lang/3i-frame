<?php if(session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Chargement des ressources -->

		<script src="https://cdn.tailwindcss.com"></script>
		<script type="module" src="../assets/js/app.js"></script>
		<title> <?= $data['title'] ?> </title>
	</head>
	<body class="w-10/12 ml-64 mt-12">
		<?php
		include_once __DIR__."/_header.php";
		include_once __DIR__."/_sidebar.php";
		?>
		<main class="">
			<?php require_once $templatePath ?>
		</main>
	</body>
</html>
