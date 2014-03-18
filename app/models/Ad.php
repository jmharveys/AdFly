<?php
class AdModel {
	//Cette page ne devrait contenir aucun html.
	public $ad;

    public function __construct() {
        $this->ad->meta = new stdClass();
        $this->ad->meta->noClient = $_POST["noClient"];
        $this->ad->meta->noAd = $_POST["noAd"];
        $this->ad->meta->date = date("c");
        $this->ad->meta->category = $_POST["category"];
        $this->ad->meta->format = $_POST["format"];
        $this->ad->screens = [];

        for($x=1; $x<=$this->ad->meta->screensNbr; $x++) {
        	array_push($this->ad->screens, $this->createScreen($x));
        }

        $this->w = intval(explode("x", $this->ad->meta->format)[0]);
        $this->h = intval(explode("h", $this->ad->meta->format)[1]);
    }

    public function createScreen($x) {
    	$screen = new stdClass();
    	$screen->price = $_POST[$x . '_price'];
    	return $screen;
    }
}
?>