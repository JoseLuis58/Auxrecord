<?php 
    require_once "./core/configGeneral.php";
    require_once "./controller/prinController.php";

    $template = new prinController();
    $template->get_template_controller();