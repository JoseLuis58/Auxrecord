<?php
$reqAjax = true;
require_once "../core/configGeneral.php";
if (isset($_GET['Token'])) {
    require_once "../controller/loginController.php";
    $logout = new loginController();
    echo $logout->exit_session_controller();
} else {
    session_start(['name' => 'AuxR']);
    session_destroy();
    echo '<script> window.location.href = "' . SERVERURL . 'login/" </script>';
}
