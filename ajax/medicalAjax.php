<?php
$reqAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['dni-his'])) {
    require_once "../controller/medicalController.php";

    $insMed = new medicalController();

    if (
        isset($_POST['dni-his']) && isset($_POST['nombre-his']) && isset($_POST['telefono-his']) && isset($_POST['lugar-his'])
        && isset($_POST['direccion-his']) && isset($_POST['pato-his']) && isset($_POST['ante-his']) && isset($_POST['cond-his'])
    ) {
        echo $insMed->add_medical_controller();
    }
} else {
    session_start(['name' => 'AuxR']);
    session_destroy();
    echo '<script> window.location.href = "' . SERVERURL . 'login/" </script>';
}
