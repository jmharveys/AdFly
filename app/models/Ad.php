<?php
class AdModel {
	public $ad;

    public function __construct() {
        $this->ad->meta = new stdClass();
        $this->ad->meta->client = $_POST["client"];
        $this->ad->meta->date = date("c");
        $this->ad->meta->screensNbr = intval($_POST["screensNbr"]);
        $this->ad->screens = [];

        for($x=1; $x<=$this->ad->meta->screensNbr; $x++) {
        	array_push($this->ad->screens, $this->createScreen($x));
        }

        // $this->w = $_POST["w"];
        // $this->h = $_POST["h"];
    }

    public function createScreen($x) {
    	$screen = new stdClass();
    	$screen->price = $_POST[$x . '_price'];
    	return $screen;
    }
}
?>