<?php 
	include 'configs/global.php';
	require 'app/libraries/Mustache/Autoloader.php';
	Mustache_Autoloader::register();
	
	$obj = new stdClass();
	$obj->app = new stdClass();
	$obj->app->culture = CULTURE;

	$isSafari = false;
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') && !strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
		$isSafari = true;
	}
	
	$obj->app->browser = new stdClass();
	$obj->app->browser->isSafari = $isSafari;

	$obj->path = new stdClass();
	$obj->path->root =      URL;
	$obj->path->styles =    URL . 'public/styles/';
	$obj->path->scripts =   URL . 'public/scripts/';
	$obj->path->images =    URL . 'public/images/';
	$obj->path->data =      URL . 'public/data/';
	$obj->path->templates = URL . 'public/templates/';

	$text = file_get_contents($obj->path->data . $culture ."/text.json");
	$obj->text = json_decode($text, true);

	$mustache = new Mustache_Engine(array(
		'loader' => new Mustache_Loader_FilesystemLoader('public/templates'),
		'partials_loader' => new Mustache_Loader_FilesystemLoader('public/templates/_partials/')
	));

	$tpl = $mustache->loadTemplate('site');
	echo $tpl->render($obj);
?>