<?php
$reqAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['account_up'])) {
    require_once "../controller/accountController.php";

    $account = new accountController();

    if (isset($_POST['account_up']) && isset($_POST['rol-up'])) {
        echo $account->update_account_controller();
    }
} else {
    session_start(['name' => 'AuxR']);
    session_destroy();
    echo '<script> window.location.href = "' . SERVERURL . 'login/" </script>';
}
