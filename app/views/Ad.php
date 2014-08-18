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
        ?>
        <link rel="stylesheet" href="<?= $this->model->ad->url->assets ?>fonts.css" type="text/css">
        <style>
        <?php
        echo $this->m->render($template, $this->ad);
        $t = file_get_contents("public/templates/styles/480x325-tpl.mustache.css");
        $t = file_get_contents("public/templates/styles/". $this->model->ad->meta->format ."-tpl.mustache.css");
        echo $this->m->render($t, $this->ad);
        ?>
        </style>
        <?php
        $styles = ob_get_clean();
        return $styles;
    }
     
    public function outputBody() {
    	ob_start();
        $template = file_get_contents("public/templates/offer-tpl.mustache.html");
        echo $this->m->render($template, $this->ad);
    	$html = ob_get_clean();
        return $html;
    }

    public function outputScripts() {
        ob_start();
        if($this->model->ad->exist->gallery) {
        ?>
        <script src="<?= $this->model->ad->url->assets ?>iscroll5.min.js"></script>
        <?php } ?>
        <script>
        <?php
            $template = file_get_contents("public/templates/scripts/offer-tpl.mustache.js");
            echo $this->m->render($template, $this->ad);
        ?>
        </script>
        <?php
            $scripts = ob_get_clean();
        $scripts.= '';
        return $scripts;
    }
}
?>