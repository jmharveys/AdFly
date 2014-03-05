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
	<label>
		<span class="lbl">Client</span><br>
		<input type="text" name="price" placeholder="La Presse" />
	</label>
	<fieldset>
		<legend>Écran</legend>
		<label>
			<span class="lbl">Prix</span><br>
			<input type="text" name="price" placeholder="1 358" />$
		</label><br>
		<label>
			<span class="lbl">Description</span><br>
			<input type="text" name="desc" placeholder="Barcelo Costa Cancun" />
		</label><br>
		<label>
			<span class="lbl">Titre</span><br>
			<input type="text" name="title" placeholder="Cancun, Mexique" />
		</label><br>
		<span class="lbl">Note</span><br>
		<label>
			<input type="radio" name="rating" value="0" checked /> Aucune
		</label>
		<label>
			<input type="radio" name="rating" value="1" /> 1
		</label>
		<label>
			<input type="radio" name="rating" value="2" /> 2
		</label>
		<label>
			<input type="radio" name="rating" value="3" /> 3
		</label>
		<label>
			<input type="radio" name="rating" value="4" /> 4
		</label>
		<label>
			<input type="radio" name="rating" value="5" /> 5 / 5
		</label><br>
		<label>
			<span class="lbl">Texte</span><br>
			<textarea name="text" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt risus ultricies diam tristique bibendum. Vestibulum lacinia vehicula auctor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis consectetur felis nec massa pretium pharetra."></textarea>
		</label><br>
		<label>
			<span class="lbl">Image</span><br>
			<input type="file" accept="image/*" capture="camera" name="picture">
		</label><br>
		<label>
			<span class="lbl">Vidéo</span><br>
			<input type="file" accept="video/*" capture="camera" name="video">
		</label>
	</fieldset>

	<label>
		<span class="lbl">Légal</span><br>
		<textarea name="legal" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt risus ultricies diam tristique bibendum. Vestibulum lacinia vehicula auctor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis consectetur felis nec massa pretium pharetra."></textarea>
	</label>
</body>
</html>