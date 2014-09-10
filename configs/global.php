<?php
	//define('URL', 'http://lapresse.ca/adfly');
	define('URL', 'http://localhost:8888/AdFly/');
	define('VERSION', '0.1');

	$culture = "fr";
	if(isset($_GET['lang'])) {
		$culture = $_GET['lang'];
	}

	$translations = file_get_contents(URL . "public/data/". $culture ."/text.json");
	$t = json_decode($translations, true);
?>