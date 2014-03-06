<?php
class AdView {
    private $model;
    private $controller;
 
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
     
    public function outputBody() {
    	ob_start(); // Cette section ne devrait presque pas contenir de PHP outre des if, else et boucles.
    	?>
            <div class="lp-ad">
                <?php for($x=0; $x<count($this->model->ad->screens); $x++) { ?>
                    <div class="screen no <?= $x; ?>">
                        <?= $x; ?>
                    </div>
                <?php } ?>
            </div>
    	<?php
    	$output = ob_get_clean();
        return $output;
    }
}
?>