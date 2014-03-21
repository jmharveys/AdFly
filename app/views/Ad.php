<?php
class AdView {
    private $model;
    private $controller;
 
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function outputStyles() {
        ob_start(); // Cette section ne devrait presque pas contenir de PHP outre des if, else et boucles.
        ?>
            .lp-ad {
                position: relative;
            }
            <?php if($this->model->ad->meta->format == "324x480") { ?>
                .lp-format-324x480 {
                    width: 324px;
                    height: 480px;
                }
            <?php } elseif($this->model->ad->meta->format == "480x152") { ?>
                .lp-format-480x152 {
                    width: 480px;
                    height: 152px;
                }
            <?php } elseif($this->model->ad->meta->format == "230x324") { ?>
                .lp-format-230x324 {
                    width: 230px;
                    height: 324px;
                }
            <?php } else { ?>
                .lp-format-230x152 {
                    width: 230px;
                    height: 152px;
                }
            <?php } ?>
        <?php
        $styles = ob_get_clean();
        ob_end_clean();
        return $styles;
    }
     
    public function outputBody() {
    	ob_start(); // Cette section ne devrait presque pas contenir de PHP outre des if, else et boucles.
    	?>
            <div class="lp-ad lp-format-<?= $this->model->ad->meta->format; ?>">
                <?php for($x=0; $x<count($this->model->ad->screens); $x++) { ?>
                    <div class="screen no <?= $x; ?>">
                        <?= $x; ?>
                    </div>
                <?php } ?>
            </div>
    	<?php
    	$output = ob_get_clean();
        ob_end_clean();
        return $output;
    }

    public function outputScripts() {
        ob_start(); // Cette section ne devrait presque pas contenir de PHP outre des if, else et boucles.
        ?>
        <?php
        $output = ob_get_clean();
        ob_end_clean();
        return $output;
    }
}
?>