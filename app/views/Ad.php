<?php
class AdView {
    private $model;
    private $controller;
 
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function outputStyles() {
        ob_start();
            $ad = $this->model->ad;
            $m = new Mustache_Engine;
            $template = file_get_contents("public/templates/styles/offer-tpl.mustache.css");
            print_r($ad); 
            echo $m->render($template, $ad);
            if($this->model->ad->meta->format == "480x325") {
                $t480x325 = file_get_contents("public/templates/styles/offer480x325-tpl.mustache.css");
                echo $m->render($t480x325, $ad);
            }
        ?>
        <?php
        $styles = ob_get_clean();
        ob_end_clean();
        return $styles;
    }
     
    public function outputBody() {
    	ob_start();
    	?>
            <div class="lp-ad lp-<?= $this->model->ad->meta->format; ?>">
                <div class='lp-flip'> 
                    <div class='lp-front'>
                        <div class="lp-logo"></div>
                        <div class='lp-gallery'>
                            <div class='lp-scroller'>
                            <?php 
                                for($x=0; $x<$this->model->ad->offers->nbr; $x++) { 
                                    $offer = $this->model->ad->offers->list[$x];
                                    $m = new Mustache_Engine;
                                    $template = file_get_contents("public/templates/offer-front-tpl.mustache.html");
                                    echo $m->render($template, $offer);
                                } 
                             ?>
                            </div>
                        </div>
                    </div>
                    <div class='lp-back'>
                        <div class='lp-gallery'>
                            <div class='lp-scroller'>
                            <?php
                                for($x=0; $x<$this->model->ad->offers->nbr; $x++) { 
                                    $offer = $this->model->ad->offers->list[$x];
                                    $m = new Mustache_Engine;
                                    $template = file_get_contents("public/templates/offer-back-tpl.mustache.html");
                                    echo $m->render($template, $offer);
                                } 
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<?php
    	$output = ob_get_clean();
        ob_end_clean();
        return $output;
    }

    public function outputScripts() {
        ob_start();
        ?>x        
        <?php
        $output = ob_get_clean();
        ob_end_clean();
        return $output;
    }
}
?>