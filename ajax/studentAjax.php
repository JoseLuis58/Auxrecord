<?php
$reqAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['dni-reg']) || isset($_POST['Code-Del']) || isset($_POST['cuenta-up'])) {
    require_once "../controller/userController.php";

    $insSt = new userController();

    if (isset($_POST['id_person-reg']) && isset($_POST['grado-reg']) && isset($_POST['direcG-reg'])) {
        echo $insSt->add_user_controller();
    }
} else {
    session_start(['name' => 'AuxR']);
    session_destroy();
    echo '<script> window.location.href = "' . SERVERURL . 'login/" </script>';
}
