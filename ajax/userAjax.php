<?php
$reqAjax = true;
require_once "../core/configGeneral.php";
if (isset($_POST['dni-reg']) || isset($_POST['Code-Del']) || isset($_POST['cuenta-up'])) {
    require_once "../controller/userController.php";
    
    $insUser = new userController();

    if (
        isset($_POST['dni-reg']) && isset($_POST['nombre-reg']) && isset($_POST['apellido-reg'])
        && isset($_POST['telefono-reg']) && isset($_POST['dire-reg']) || isset($_POST['usuario-reg'])
        || isset($_POST['password1-reg']) || isset($_POST['password2-reg']) || isset($_POST['email-reg']) || isset($_POST['id_person-reg']) || isset($_POST['grado-reg']) || isset($_POST['direcG-reg'])
    ) {
        echo $insUser->add_user_controller();
        
    }

    if (isset($_POST['Code-Del']) && isset($_POST['Rol-Del'])) {
        echo $insUser->delete_user_controller();
    }

    if (isset($_POST['cuenta-up']) && isset($_POST['dni-up'])) {
        echo $insUser->update_user_controller();
    }
} else {
    session_start(['name' => 'AuxR']);
    session_destroy();
    echo '<script> window.location.href = "' . SERVERURL . 'login/" </script>';
}
