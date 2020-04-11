<?php
$reqAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['dni-reg']) || isset($_POST['codigo-del'])) {

    require_once "../controller/medicalCareController.php";

    $insMe = new medicalCareController();

    if (
        isset($_POST['dni-reg']) && isset($_POST['optionsEgre']) && isset($_POST['observaciones-reg'])
        && isset($_POST['rec-reg'])
    ) {
        echo $insMe->add_medicalCare_controller();
    }
    if (isset($_POST['codigo-del']) && isset($_POST['privilegio-admin'])) {
        echo $insMe->delete_medicalCare_controller();
    }
} else {
    session_start(['name' => 'AuxR']);
    session_destroy();
    echo '<script> window.location.href = "' . SERVERURL . 'login/" </script>';
}
