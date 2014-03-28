<?php
	$id = $_POST["id"];
	$html = $_POST["h"];
	try {
		$html = str_replace("temps/". $id ."/", "", $html);
		$html = str_replace("public/images", "assets", $html);
		file_put_contents('../../temps/' . $id . '/index.html', $html);
	} catch(Exception $e) {
	    echo "error";
	}
?>