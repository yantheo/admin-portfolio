<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
	<?php require_once './view/component/menu.php'; ?>
	<div class="container">
		<h1 class="rounded border border-dark m-2 p-2 text-center text-white bg-info">
			<?= $titre ?>
		</h1>
		<?php if(!empty($_SESSION['alert'])) :?>
			<div class="alert <?= $_SESSION['alert']['type']?>" role="alert">
				 <?= $_SESSION['alert']['message']?>
			</div>
		<?php 
			unset($_SESSION['alert']);
			endif; 
		?>
		<?= $content ?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>