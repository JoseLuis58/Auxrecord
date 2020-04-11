<?php 
    if ($reqAjax) {
        require_once "../models/loginModel.php";
    } else {
        require_once "./models/loginModel.php";
    }

    class loginController extends loginModel{

        public function login_controller(){
            $Username = mainModel::clean_char($_POST['Usuario']);
            $Password = mainModel::clean_char($_POST['Contraseña']);

            // $Password = mainModel::encryption($Password);

            $data = [
                "Username"=>$Username,
                "Password"=>$Password
                ];

            $dataU = loginModel::login_model($data);

            if ($dataU->rowCount()==1) {
                $row = $dataU->fetch();

                $date=date("Y-m-d");
                $year=date("Y");
                $hour=date("h:i:s a");

                $query=mainModel::exec_simple_query("SELECT id FROM bitacora");
                $numero = ($query->rowCount())+1;

                $codeB=mainModel::random_code("CB",7,$numero);

                $datosB=[
                    "BitacoraCodigo"=>$codeB,
                    "BitacoraFecha"=>$date,
                    "BitacoraHoraInicio"=>$hour,
                    "BitacoraHoraFinal"=>"Sin registro",
                    "BitacoraTipo"=>$row['Rol'],
                    "BitacoraYear"=>$year,
                    "CodeBita"=>$row['Code_Account']
                ];

                $saveB = mainModel::add_bitacora($datosB);
                if ($saveB->rowCount()>=1) {
                   session_start(['name'=>'AuxR']);
                   $_SESSION['Username_AuxR']=$row['Username'];
                   $_SESSION['Rol_AuxR']=$row['Rol'];
                   $_SESSION['Foto_AuxR']=$row['Photo'];
                   $_SESSION['Token_AuxR']=md5(uniqid(mt_rand(),true));
                   $_SESSION['Code_AuxR']=$row['Code_Account'];
                   $_SESSION['CodeBita_AuxR']=$codeB;

                    if ($row['Rol']=="Administrador") {
                        $url = SERVERURL."home/";
                    }elseif($row['Rol']=="Acudiente") {
                        $url = SERVERURL."persearch/";
                    }else {
                        $url = SERVERURL."login/";
                    }

                    return $urlloc='<script> window.location.href = "'.$url.'" </script>';

                } else {
                    $alerta = [
                        "Alerta"=>"simple",
                        "Title"=>"Ocurrio un error inesperado",
                        "Text"=>"No hemos podido iniciar la sesión por problemas técnicos, intente nuevamente",
                        "Type"=>"error"
                    ];
                }
                return mainModel::sweet_alert($alerta);
                
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Title"=>"Ocurrio un error inesperado",
                    "Text"=>"El usuario y la contraseña son incorrectos",
                    "Type"=>"error"
                ];
            }
            return mainModel::sweet_alert($alerta);
        }
        
        public function exit_session_controller()
        {
            session_start(['name'=>'AuxR']);
            $token = mainModel::decryption($_GET['Token']);
            $hora = date("h:i:s a");
            $datos=[
                "Username"=>$_SESSION['Username_AuxR'],
                "Token_AuxR"=>$_SESSION['Token_AuxR'],
                "Token"=>$token,
                "Code"=>$_SESSION['CodeBita_AuxR'],
                "Hora"=>$hora
            ];
            return loginModel::exit_session_model($datos);

        }

        public function close_session_controller()
        {
            session_start(['name'=>'AuxR']);
            session_destroy();
            return header("Location: ".SERVERURL."login/");
        }
    }