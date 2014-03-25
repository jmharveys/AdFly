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
                    <?php 
                        $offer = $this->model->ad->offers;
                        $m = new Mustache_Engine;
                        $template = file_get_contents("public/templates/offer-tpl.mustache.html");
                        echo $m->render($template, $offer);
                    ?>
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