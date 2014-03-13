<?php
	//define('URL', 'http://lapresse.ca/adfly');
	define('URL', 'http://localhost:8888/AdFly/');

	$culture = "fr";
	if(isset($_GET['lang'])) {
		$culture = $_GET['lang'];
	}

	$translations = file_get_contents(URL . "public/data/translations.json");
	$t = json_decode($translations, true);
?>