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
            $template   = file_get_contents("public/templates/offer-325x480-tpl.mustache.css");
            echo $m->render($template, $ad);
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
                <div class='flip'> 
                    <div class='lp-front'>
                        <div class="lp-logo"></div>
                        <div class='scroller'>
                        <?php 
                            for($x=0; $x<$this->model->ad->offers->nbr; $x++) { 
                                $offer = $this->model->ad->offers->list[$x];
                                $m = new Mustache_Engine;
                                $template   = file_get_contents("public/templates/offer-front-tpl.mustache.html");
                                echo $m->render($template, $offer);
                            } 
                         ?>
                        </div>
                    </div>
                    <div class='lp-back'>
                    <?php
                        for($x=0; $x<$this->model->ad->offers->nbr; $x++) { 
                            $offer = $this->model->ad->offers->list[$x];
                            $m = new Mustache_Engine;
                            $template   = file_get_contents("public/templates/offer-back-tpl.mustache.html");
                            echo $m->render($template, $offer);
                        } 
                    ?>
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
        ?>
        <?php
        $output = ob_get_clean();
        ob_end_clean();
        return $output;
    }
}
?>