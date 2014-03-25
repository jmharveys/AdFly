<?php 
	include 'configs/global.php';
	include 'app/libraries/utilities.php';
	include 'app/controllers/Ad.php';
	include 'app/models/Ad.php'; 
	include 'app/views/Ad.php'; 

	require 'app/libraries/Mustache/Autoloader.php';
	Mustache_Autoloader::register();

	$model = new AdModel();
	$controller = new AdController($model);
	$view = new AdView($view, $model);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title><?= $model->ad->meta->format ?></title>
	<meta name='format-detection' content='telephone=no'>
	<meta name='author' content='La Presse'>
	<meta name='dcterms.date' content='<?= date("Y-m-d"); ?>'>
	<style>
		html, body {
			width: 100%;
			height: 100%;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}
		<?= $view->outputStyles(); ?>
	</style>
</head>
<body>
	<?= $view->outputBody(); ?>
	<script src="<?= URL ?>public/scripts/ad-basic.js"></script>
	<?= $view->outputScripts(); ?>
</body>
</html>