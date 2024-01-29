<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Chargement des ressources -->
        <script src="assets/js/app.js"></script>
		<script src="https://cdn.tailwindcss.com"></script>

		<title> <?= $data['title'] ?> </title>
	</head>
	<body>
		<main>
			<?php require_once $templatePath ?>
		</main>
	</body>
</html>
