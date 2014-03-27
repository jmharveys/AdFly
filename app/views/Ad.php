<?php
class AdView {
    private $model;
    private $controller;
    public $ad;
    private $m;
 
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
        $this->ad = $this->model->ad;
        $this->m = new Mustache_Engine;
    }

    public function outputStyles() {
        ob_start();
        $template = file_get_contents("public/templates/styles/offer-tpl.mustache.css");
        echo $this->m->render($template, $this->ad);
        $t = file_get_contents("public/templates/styles/". $this->model->ad->meta->format ."-tpl.mustache.css");
        echo $this->m->render($t, $this->ad);
        $styles = ob_get_clean();
        ob_end_clean();
        return $styles;
    }
     
    public function outputBody() {
    	ob_start();
        $template = file_get_contents("public/templates/offer-tpl.mustache.html");
        echo $this->m->render($template, $this->ad);
    	$html = ob_get_clean();
        ob_end_clean();
        return $html;
    }

    public function outputScripts() {
        ob_start();
        ?>
        <script src="public/scripts/min/iscroll5.min.js"></script>
        <script>
            console.log(<?= json_encode($this->model->ad) ?>);
        <?php
            $template = file_get_contents("public/templates/scripts/offer-tpl.mustache.js");
            echo $this->m->render($template, $this->ad);
        ?>
        </script>
        <?php
            $scripts = ob_get_clean();
            ob_end_clean();
        $scripts.= '';
        return $scripts;
    }
}
?>