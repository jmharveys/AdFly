<?php
	header('Content-Type: text/plain; charset=utf-8');

	try {
	    if(!isset($_FILES['adzip']['error']) || is_array($_FILES['adzip']['error'])) {
	        throw new RuntimeException('Invalid parameters.');
	    }
	    switch ($_FILES['adzip']['error']) {
	        case UPLOAD_ERR_OK:
	            break;
	        case UPLOAD_ERR_NO_FILE:
	            throw new RuntimeException('Aucun ZIP envoyé');
	        case UPLOAD_ERR_INI_SIZE:
	        case UPLOAD_ERR_FORM_SIZE:
	            throw new RuntimeException('Le ZIP dépasse la limite de poids permise');
	        default:
	            throw new RuntimeException('Erreur Inconnue');
	    }
	    if($_FILES['adzip']['size'] > 40000000) {
	        throw new RuntimeException('Le ZIP dépasse la limite de poids permise');
	    }

	    $zip = new ZipArchive;
	    $date = new DateTime();
	    $timestamp = $date->getTimestamp();
	    if($zip->open($_FILES['adzip']['tmp_name']) === TRUE) {
		    $zip->extractTo('../../temps/' . $timestamp . '/');
		    $zip->close();
		    echo $timestamp;
		} else {
		    echo 'La décompression du Zip à échoué';
		}
	} catch (RuntimeException $e) {
	    echo $e->getMessage();
	}
?>