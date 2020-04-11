<?php
if ($reqAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class accountController extends mainModel
{

    public function data_user_controller($code)
    {
        $code = mainModel::decryption($code);

        return mainModel::data_user($code);
    }

    public function update_account_controller()
    {
        $accountCode = mainModel::decryption($_POST['account_up']);
        $accountRol = mainModel::decryption($_POST['rol-up']);

        $sql = mainModel::exec_simple_query("SELECT * FROM user WHERE Code_Account='$accountCode'");

        $DAcco = $sql->fetch();

        $user = mainModel::clean_char($_POST['usuario-up']);
        $pass = mainModel::clean_char($_POST['password-up']);

        if ($user != "" && $pass != "") {
            if (isset($_POST['rol-up'])) {
                $login = mainModel::exec_simple_query("SELECT Id FROM user WHERE Username='$user' AND Password='$pass'");
            } else {
                $login = mainModel::exec_simple_query("SELECT Id FROM user WHERE Username='$user' 
                    AND Password='$pass' AND Code_Account='$accountCode'");
            }
            if ($login->rowCount() == 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "El usuario y la contraseña que acaba de ingresar 
                            no coinciden con los datos de su cuenta",
                    "Type" => "error"
                ];
                return mainModel::sweet_alert($alerta);
                exit();
            }
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "El usuario y la contraseña no pueden estar vacios, 
                            por favor ingrese los datos he intente nuevamente",
                "Type" => "error"
            ];
            return mainModel::sweet_alert($alerta);
            exit();
        }

        //VERIFICACION USUARIO

        $nuevo = mainModel::clean_char($_POST['new-user']);
        if ($nuevo == "") {
            $nuevo=$user;
        } else {
            if ($nuevo != $DAcco['Username']) {
                $sql = mainModel::exec_simple_query("SELECT Username FROM user WHERE Username='$nuevo'");
                if ($sql->rowCount() >= 1) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Title" => "Ocurrio un error inesperado",
                        "Text" => "El nombre de usuario que acaba de ingresar ya se encuentra registrado en el sistema",
                        "Type" => "error"
                    ];
                    return mainModel::sweet_alert($alerta);
                    exit();
                }
            }
        }



        //VERIFICACION EMAIL

        $email = mainModel::clean_char($_POST['email-up']);
        if ($email != $DAcco['Email']) {
            $sql1 = mainModel::exec_simple_query("SELECT Email FROM user WHERE Email='$email'");
            if ($sql1->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "El Email que acaba de ingresar ya se encuentra registrado en el sistema",
                    "Type" => "error"
                ];
                return mainModel::sweet_alert($alerta);
                exit();
            }
        }

        //NUEVO GENERO

        $genero = mainModel::clean_char($_POST['optionsGenero']);
        if ($accountRol = "Admin") {
            if ($genero == "Masculino") {
                $photo = "TeacherMaleAvatar.png";
            } else {
                $photo = "TeacherFemaleAvatar.png";
            }
        } else {
            if ($genero == "Masculino") {
                $photo = "StudetMaleAvatar.png";
            } else {
                $photo = "StudetFemaleAvatar.png";
            }
        }

        //NUEVAS CONTRASEÑAS

        $passwordN1 = mainModel::clean_char($_POST['newPassword1-up']);
        $passwordN2 = mainModel::clean_char($_POST['newPassword2-up']);
        if ($passwordN1 != "" || $passwordN2 != "") {
            if ($passwordN1 == $passwordN2) {
                $passAcc = $passwordN1;
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "Las nuevas contraseñas no coinciden por favor verifique los datos e intente nuevamente",
                    "Type" => "error"
                ];
                return mainModel::sweet_alert($alerta);
                exit();
            }
        } else {
            $passAcc = $DAcco['Password'];
        }

        //ENVIO DE DATOS AL MODELO
        $dataUp = [
            "Code" => $accountCode,
            "Username" => $nuevo,
            "Password" => $passAcc,
            "Email" => $email,
            "Gender" => $genero,
            "Photo" => $photo
        ];

        if (mainModel::update_user($dataUp)) {
            if (!isset($_POST['rol-up'])) {
                session_start(['name' => 'AuxR']);
                $_SESSION['Username_AuxR'] = $nuevo;
                $_SESSION['Foto_AuxR'] = $photo;
            }
            $alerta = [
                "Alerta" => "reload",
                "Title" => "Cuenta actualizada",
                "Text" => "Los datos de la cuenta se actualizaron con exito",
                "Type" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "Lo sentimos no hemos podido actualizar los datos de la cuenta",
                "Type" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }
}
