<?php if(session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Chargement de TailwindCss -->

		<script src="https://cdn.tailwindcss.com"></script>

        <!-- Chargement de JQuery -->
        <script
            src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous">
        </script>

		<script type="module" src="../assets/js/app.js"></script>

		<title> <?= $data['title'] ?> </title>
	</head>
	<body class="lg:w-9/12 lg:ml-64 mt-12">
		<?php
		include_once __DIR__."/_header.php";
		include_once __DIR__."/_sidebar.php";
		?>
		<main class="">
			<?php require_once $templatePath ?>
		</main>
	</body>
</html>

<script>
    $.ajaxSetup({
        data: {
            csrf_token: '<?= $_SESSION['csrf_token'] ?>'
        }
    });
</script>
