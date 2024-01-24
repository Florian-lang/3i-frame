<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> <?= $data['title'] ?> </title>
	</head>
	<body>
		<?php include_once '_header.php'; ?>
		<main>
			<?php require_once $templatePath ?>
		</main>
		<?php include_once '_footer.php'; ?>
	</body>
</html>
