<?php 
	include 'configs/global.php'; 
?>
<!DOCTYPE html>
<!--[if lt IE 8]> <html class="lt-ie10 lt-ie9 lt-ie8" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie10 lt-ie9" lang="fr"> <![endif]-->
<!--[if IE 9]>    <html class="lt-ie10" lang="fr"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="fr"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Formulaire | AdFly </title>
	<meta name="description" property="og:description" content="Outils de création publicitaire pour les annonceurs de La Presse+." />
	<meta name="author" content="Jonathan Harvey, Simon Arnold" />
	<meta property="og:type" content="website"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" media="all" href="<?= URL ?>public/styles/form.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<form method="post" action="ad.php" enctype="multipart/form-data" autocomplete="off">
		<label>
			<span class="lbl">Client</span><br>
			<input type="text" name="price" placeholder="La Presse" />
		</label>

		<a href="#" class="addScreen">Ajouter un écran</a>
		<section class="screensList">
			<!-- public/templates/screen-tpl.mustache.html -->
		</section>

		<label>
			<span class="lbl">Légal</span><br>
			<textarea name="legal" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt risus ultricies diam tristique bibendum. Vestibulum lacinia vehicula auctor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis consectetur felis nec massa pretium pharetra."></textarea>
		</label>
	</form>

	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?= URL ?>public/scripts/min/jquery-1.11.0.min.js"> \x3C/script>')</script>
    <script src="<?= URL ?>public/scripts/min/mustache.min.js"></script>
	<script src="<?= URL ?>public/scripts/form.js"></script>
	<script>
		$(document).ready(function() {
          _g = new app();
        });
	</script>
</body>
</html>