<?php
class AdModel {
	//Cette page ne devrait contenir aucun html.
	public $ad;

    public function __construct() {
        $date = new DateTime();
        $settings = new stdClass();
        $settings->f480x325 = new stdClass();
        $settings->f480x325->logo = new stdClass();
        $settings->f480x325->logo->w = 165;
        $settings->f480x325->logo->h = 75;
        $settings->f480x152 = new stdClass();
        $settings->f480x152->logo = new stdClass();
        $settings->f480x152->logo->w = 100;
        $settings->f480x152->logo->h = 50;
        $settings->f230x325 = new stdClass();
        $settings->f230x325->logo = new stdClass();
        $settings->f230x325->logo->w = 100;
        $settings->f230x325->logo->h = 50;
        $settings->f230x152 = new stdClass();
        $settings->f230x152->logo = new stdClass();
        $settings->f230x152->logo->w = 75;
        $settings->f230x152->logo->h = 30;
        $settings->months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

        $this->ad->meta = new stdClass();
        $this->ad->meta->id = $_POST["id"];
        $this->ad->meta->noClient = $_POST["noClient"];
        $this->ad->meta->noAd = $_POST["noAd"];
        $this->ad->meta->date = date("c");
        $this->ad->meta->category = $_POST["category"];
        $this->ad->meta->format = $_POST["format"];
        $this->ad->meta->f480x325 = false;
        $this->ad->meta->f480x152 = false;
        $this->ad->meta->f230x325 = false;
        $this->ad->meta->f230x152 = false;
        $this->ad->meta->{'f' . $this->ad->meta->format} = true;
        $this->ad->meta->version = VERSION;

        $this->ad->w = intval(explode("x", $this->ad->meta->format)[0]);
        $this->ad->h = intval(explode("x", $this->ad->meta->format)[1]);

        $this->ad->url = new stdClass();
        $this->ad->url->root = URL;
        $this->ad->url->folder = 'temps/' . $this->ad->meta->id;
        $this->ad->url->assets = $this->ad->url->folder . '/assets/';

        $this->ad->assets = ['images/basic@2x.png', 'fonts/americantype/ameritypbol-webfont.eot', 'fonts/americantype/ameritypbol-webfont.svg', 'fonts/americantype/ameritypbol-webfont.ttf', 'fonts/americantype/ameritypbol-webfont.woff', 'fonts/americantype/ameritypmed-webfont.eot', 'fonts/americantype/ameritypmed-webfont.svg', 'fonts/americantype/ameritypmed-webfont.ttf', 'fonts/americantype/ameritypmed-webfont.woff', 'styles/fonts.css'];

        $this->ad->logo = new stdClass();
        $this->ad->logo->tmp = $_FILES['logo']['tmp_name'];
        $this->ad->logo->dflt = $_FILES['logo']['name'];
        $this->ad->logo->ext = end(explode(".", $this->ad->logo->dflt));
        $this->ad->logo->name = 'logo.' . $this->ad->logo->ext;
        $this->ad->logo->path = $this->ad->url->assets . $this->ad->logo->name;
        list($this->ad->logo->w, $this->ad->logo->h) = getimagesize($this->ad->logo->tmp);
        $this->ad->logo->ratio = $this->ad->logo->w / $this->ad->logo->h;
        if($this->ad->logo->ratio > 1) {
            $this->ad->logo->w = $settings->{'f' . $this->ad->meta->format}->logo->w;
            $this->ad->logo->h = $settings->{'f' . $this->ad->meta->format}->logo->w / $this->ad->logo->ratio;
        } else {
            $this->ad->logo->w = $settings->{'f' . $this->ad->meta->format}->logo->h * $this->ad->logo->ratio;
            $this->ad->logo->h = $settings->{'f' . $this->ad->meta->format}->logo->h;
        }
        array_push($this->ad->assets, $this->ad->logo);

        $id = explode(",", $_POST["offersId"]);
        $this->ad->offers = new stdClass();
        $this->ad->offers->nbr = count($id);
        $this->ad->offers->list = [];

        $this->ad->scroller = new stdClass();
        $this->ad->scroller->w = $this->ad->w * $this->ad->offers->nbr;

        $this->ad->exist = new stdClass();
        $this->ad->exist->mentions = false;
        $this->ad->exist->price = false;
        $this->ad->exist->date = false;
        $this->ad->exist->rating = false;
        $this->ad->exist->video = false;
        $this->ad->exist->gallery = false;
        $this->ad->exist->offersGallery = $this->ad->offers->nbr > 1 ? true : false;
        $this->ad->exist->picturesGallery = false;
        $this->ad->exist->legal = false;

        for($x=0; $x<$this->ad->offers->nbr; $x++) {
            $obj = new stdClass();
            /* ID */
            $obj->id = $id[$x];
            /* Index */
            $obj->index = $x + 1;
            /* Destination */
            $dest = nl2br($_POST[$obj->id . "_destination"]);
            $dest = strip_tags($dest, '<br>');
            $obj->destination = $dest;
            /* More Destination */
            $more = nl2br($_POST[$obj->id . "_moreDestination"]);
            $more = strip_tags($more, '<br>');
            $obj->moreDestination = $more;
            /* Price */
            if(isset($_POST[$obj->id . "_price"])) {
                $this->ad->exist->price = true;
                $price = intval($_POST[$obj->id . "_price"]);
                $price = number_format($price, 0, '',' ');
                $obj->price = $price;
            }
            /* Date */
            if(isset($_POST[$obj->id . "_date"])) {
                $this->ad->exist->date = true;
                $obj->date = new stdClass();
                $obj->date->raw = $_POST[$obj->id . "_date"];
                $dateArr = explode("-", $obj->date->raw);
                $obj->date->year = intval($dateArr[0]);
                $obj->date->month = $settings->months[intval($dateArr[1]) -1];
                $obj->date->day = intval($dateArr[2]);
                $obj->date->text = $obj->date->day ." ". $obj->date->month ." ". $obj->date->year;
            }
            /* Heure */
            if(isset($_POST[$obj->id . "_date"])) {
                $obj->time = new stdClass();
                $obj->time->raw = $_POST[$obj->id . "_time"];
                $timeArr = explode(":", $obj->time->raw);
                $obj->time->text = intval($timeArr[0]) ."h ". $timeArr[1];
            }
            /* Mentions */
            $obj->mentions = [];
            /* Mention 1 */
            $mention1 = $_POST[$obj->id . "_mention_1"] === "freetext" ? $_POST[$obj->id . "_mention_1_freetext"] : $_POST[$obj->id . "_mention_1"];
            if($mention1 !== "") {
                $this->ad->exist->mentions = true;
                array_push($obj->mentions, $mention1);
            }
            /* Mention 2 */
            $mention2 = $_POST[$obj->id . "_mention_2"] === "freetext" ? $_POST[$obj->id . "_mention_2_freetext"] : $_POST[$obj->id . "_mention_2"];
            if($mention2 !== "") {
                $this->ad->exist->mentions = true;
                array_push($obj->mentions, $mention2);
            }
            /* Rating */
            $obj->rating = intval($_POST[$obj->id . "_rating"]);
            if($obj->rating > 0) {
                $this->ad->exist->rating = true;
            }
            /* Link */
            $obj->link = trim($_POST[$obj->id . "_link"]);
            /* Image(s) */
            $obj->gallery = new stdClass();
            $obj->gallery->pictures = array();
            foreach($_FILES[$obj->id . '_picture']['tmp_name'] as $key => $tmp_name) {
                $name = $_FILES[$obj->id . '_picture']['name'][$key];
                if($name != '') {
                    $img = new stdClass();
                    $img->name = $name;
                    $img->tmp = $_FILES[$obj->id . '_picture']['tmp_name'][$key];
                    $img->index = $key + 1;
                    $img->path = $this->ad->url->assets . $name;

                    array_push($obj->gallery->pictures, $img);
                    array_push($this->ad->assets, $img);
                }
            }
            $obj->gallery->nbr = count($obj->gallery->pictures);
            $obj->gallery->w = $obj->gallery->nbr * $this->ad->w;
            $obj->gallery->exist = $obj->gallery->nbr > 1 ? true : false;
            if($obj->gallery->exist) {
                $this->ad->exist->picturesGallery = true;
            }
            /* Video */
            $obj->video = new stdClass();
            $videoName = $_FILES[$obj->id . '_video']['name'];
            $obj->video->exist = $videoName == '' ? false : true;
            if($obj->video->exist) {
                $this->ad->exist->video = true;
                $obj->video->path = $this->ad->url->assets . $videoName;
                $obj->video->name = $videoName;
                $obj->video->tmp = $_FILES[$obj->id . '_video']['tmp_name'];
                $obj->video->ext = end(explode(".", $obj->video->name));
                array_push($this->ad->assets, $obj->video);
            }
            /* Description */
            $obj->description = $_POST[$obj->id . "_description"];
            /* Légal */
            $obj->legal = new stdClass();
            $obj->legal->text = trim($_POST[$obj->id . "_legal"]);
            $obj->legal->exist = $obj->legal->text == '' ? false : true;
            if($obj->legal->exist) {
                $this->ad->exist->legal = true;
            }

            array_push($this->ad->offers->list, $obj);
        }

        if($this->ad->exist->rating) {
            if($this->ad->meta->format === "480x325") {
                array_push($this->ad->assets, 'images/starBig@2x.png');
            } else {
                array_push($this->ad->assets, 'images/star@2x.png');
            }
        }
        if($this->ad->exist->video) {
            array_push($this->ad->assets, 'images/video@2x.png');
        }
        if($this->ad->exist->offersGallery || $this->ad->exist->picturesGallery) {
            $this->ad->exist->gallery = true;
            array_push($this->ad->assets, 'scripts/min/iscroll5.min.js');
        }

        $this->createFolder();
        $this->adAssets($this->ad->assets);
        $this->createJsonObj();

        //print_r($this->ad);
    }

    private function createFolder() {
        rrmdir($this->ad->url->folder);
        umask(0);
        if(!mkdir($this->ad->url->folder, 0777, true)) {
            die('Echec lors de la création du répertoire');
        }
        mkdir($this->ad->url->folder, 0777, true);
        mkdir($this->ad->url->assets, 0777, true);
    }

    private function adAssets($assets) {
        $folder = 'temps/' . $this->ad->meta->id . "/assets/";
        for($x=0; $x<count($assets); $x++) {
            if(!move_uploaded_file($assets[$x]->tmp, $folder . $assets[$x]->name)) {
                copy('public/' . $assets[$x], $folder . end(explode("/", $assets[$x])));
            }
        }
    }

    private function createJsonObj() {
         $folder = 'temps/' . $this->ad->meta->id . "/assets/";
         $obj = json_encode($this->ad);
         file_put_contents($folder . '/_source.json', $obj);
    }
}
?>