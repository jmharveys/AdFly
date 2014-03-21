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

        $this->ad->w = intval(explode("x", $this->ad->meta->format)[0]);
        $this->ad->h = intval(explode("x", $this->ad->meta->format)[1]);

        $id = explode(",", $_POST["offersId"]);
        $this->ad->offers = new stdClass();
        $this->ad->offers->nbr = count($id);
        $this->ad->offers->list = [];

        for($x=0; $x<$this->ad->offers->nbr; $x++) {
            $obj = new stdClass();
            /* ID */
            $obj->id = $id[$x];
            /* Destination */
            $obj->destination = $_POST[$obj->id . "_destination"];
            /* More Destination */
            $obj->moreDestination = $_POST[$obj->id . "_moreDestination"];
            /* Price */
            if(isset($_POST[$obj->id . "_price"])) {
                $price = intval($_POST[$obj->id . "_price"]);
                $price = number_format($price, 0, '',' ');
                $obj->price = $price;
            }
            /* Date */
            if(isset($_POST[$obj->id . "_date"])) {
                $obj->date = $_POST[$obj->id . "_date"];
            }
            /* Mentions */
            $obj->mentions = [];
            /* Mention 1 */
            $mention1 = $_POST[$obj->id . "_mention_1"] === "freetext" ? $_POST[$obj->id . "_mention_1_freetext"] : $_POST[$obj->id . "_mention_1"];
            if($mention1 !== "") {
                array_push($obj->mentions, $mention1);
            }
            /* Mention 2 */
            $mention2 = $_POST[$obj->id . "_mention_2"] === "freetext" ? $_POST[$obj->id . "_mention_2_freetext"] : $_POST[$obj->id . "_mention_2"];
            if($mention2 !== "") {
                array_push($obj->mentions, $mention2);
            }
            /* Rating */
            $obj->rating = $_POST[$obj->id . "_rating"];
            /* Link */
            $obj->link = $_POST[$obj->id . "_link"];
            /* Description */
            $obj->description = $_POST[$obj->id . "_description"];
            /* Légal */
            $obj->legal = $_POST[$obj->id . "_legal"];

            array_push($this->ad->offers->list, $obj);
        }
        print_r($this->ad);
    }
}
?>