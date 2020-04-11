<?php
$reqAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['id_person-reg']) || isset($_POST['codigo-del']) || isset($_POST['id_person-up'])) {

    require_once "../controller/nurseController.php";

    $insEv = new nurseController();

    if (
        isset($_POST['id_person-reg']) && isset($_POST['nombre-reg']) && isset($_POST['telefono-reg'])
        && isset($_POST['dire-reg']) && isset($_POST['nomAcu-reg']) && isset($_POST['horaIng-reg'])
        && isset($_POST['sign-reg']) && isset($_POST['motivo-reg'])
    ) {
        echo $insEv->add_event_controller();
    }
    if (isset($_POST['codigo-del']) && isset($_POST['privilegio-admin'])) {
        echo $insEv->delete_event_controller();
    }
    if (isset($_POST['id_person-up']) && isset($_POST['nombre-up'])) {
        echo $insEv->update_event_controller();
    }
} else {
    session_start(['name' => 'AuxR']);
    session_destroy();
    echo '<script> window.location.href = "' . SERVERURL . 'login/" </script>';
}
