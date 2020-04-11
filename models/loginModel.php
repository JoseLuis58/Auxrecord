<?php 
    if ($reqAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }

    class loginModel extends mainModel{

        protected function login_model($data)
        {
            $sql = mainModel::connect()->prepare("SELECT * FROM user WHERE Username=:Username AND Password=:Password");
            $sql->bindParam(':Username',$data['Username']);
            $sql->bindParam(':Password',$data['Password']);
            $sql->execute();
            return $sql;
        }
        protected function exit_session_model($data)
        {
            if ($data['Username']!="" && $data['Token_AuxR']==$data['Token']) {
                $Ubitacora=mainModel::update_bitacora($data['Code'],$data['Hora']);
                if ($Ubitacora->rowCount()==1) {
                    session_unset();
                    session_destroy();
                    $answer = "true";
                } else {
                    $answer = "false";
                }
                
            } else {
                $answer = "false";
            }
            return $answer;
        }
    }
