<?php
    if ($reqAjax) {
        require_once "../core/configAPP.php";
    } else {
        require_once "./core/configAPP.php";
    }
    
    class mainModel{

        protected function connect(){
            $link = new PDO(SGBD,USER,PASS);
            return $link;
        }

        protected function exec_simple_query($query){
            $answer = mainModel::connect()->prepare($query);
            $answer->execute();
            return $answer;
        }

        protected function add_user($data)
        {
            $sql = mainModel::connect()->prepare("INSERT INTO user(Username,Password,Email,Rol,Photo,Gender,Code_Account) 
                    VALUES(:Username,:Password,:Email,:Rol,:Photo,:Gender,:Code_Account)");
            $sql->bindParam(":Username",$data['Username']);
            $sql->bindParam(":Password",$data['Password']);
            $sql->bindParam(":Email",$data['Email']);
            $sql->bindParam(":Rol",$data['Rol']);
            $sql->bindParam(":Photo",$data['Photo']);
            $sql->bindParam(":Gender",$data['Gender']);
            $sql->bindParam(":Code_Account",$data['Code_Account']);
            $sql->execute();
            return $sql;
        }

        protected function delete_user($code)
        {
            $sql = mainModel::connect()->prepare("DELETE FROM user WHERE Code_Account=:Code");
            $sql->bindParam(":Code",$code);
            $sql->execute();
            return $sql;
        }

        protected function data_user($code)
        {
            $sql = mainModel::connect()->prepare("SELECT * FROM user WHERE Code_Account=:Code");
            $sql->bindParam(":Code",$code);
            $sql->execute();
            return $sql;
        }

        protected function update_user($data)
        {
            $sql = mainModel::connect()->prepare("UPDATE user SET Username=:Username,Password=:Password,
            Email=:Email,Photo=:Photo,Gender=:Gender WHERE Code_Account=:Code");
            $sql->bindParam(":Username",$data['Username']);
            $sql->bindParam(":Password",$data['Password']);
            $sql->bindParam(":Email",$data['Email']);
            $sql->bindParam(":Gender",$data['Gender']);
            $sql->bindParam(":Photo",$data['Photo']);
            $sql->bindParam(":Code",$data['Code']);
            $sql->execute();
            return $sql;
        }

        protected function add_bitacora($data)
        {
            $sql = mainModel::connect()->prepare("INSERT INTO bitacora(BitacoraCodigo,BitacoraFecha,
                        BitacoraHoraInicio,BitacoraHoraFinal,BitacoraTipo,BitacoraYear,CodeBita) 
                        VALUES(:BitacoraCodigo,:BitacoraFecha,:BitacoraHoraInicio,:BitacoraHoraFinal,
                                :BitacoraTipo,:BitacoraYear,:CodeBita)");
            $sql->bindParam(":BitacoraCodigo",$data['BitacoraCodigo']);
            $sql->bindParam(":BitacoraFecha",$data['BitacoraFecha']);
            $sql->bindParam(":BitacoraHoraInicio",$data['BitacoraHoraInicio']);
            $sql->bindParam(":BitacoraHoraFinal",$data['BitacoraHoraFinal']);
            $sql->bindParam(":BitacoraTipo",$data['BitacoraTipo']);
            $sql->bindParam(":BitacoraYear",$data['BitacoraYear']);
            $sql->bindParam(":CodeBita",$data['CodeBita']);
            $sql->execute();
            return $sql;
        }
        
        protected function update_bitacora($code,$hora)
        {
            $sql = mainModel::connect()->prepare("UPDATE bitacora SET BitacoraHoraFinal=:Hora 
                                        WHERE BitacoraCodigo=:Code");
            $sql->bindParam(":Hora",$hora);
            $sql->bindParam(":Code",$code);
            $sql->execute();
            return $sql;
        }

        public function delete_bitacora($code)
        {
            $sql = mainModel::connect()->prepare("DELETE FROM bitacora WHERE CodeBita =:Code");
            $sql->bindParam(":Code",$code);
            $sql->execute();
            return $sql;
        }

        public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
        }
        
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
        }
        
        protected function random_code($letter,$length,$num){
            for ($i=1; $i <=$length ; $i++) { 
                $number = rand(0,9);
                $letter.= $number;
            }
            return $letter."-".$num;
        }

        protected function clean_char($string){
            $string = trim($string);
            $string = stripcslashes($string);
            $string = str_ireplace("<script>","",$string);
            $string = str_ireplace("</script>","",$string);
            $string = str_ireplace("<script src","",$string);
            $string = str_ireplace("<script type=","",$string);
            $string = str_ireplace("SELECT * FROM","",$string);
            $string = str_ireplace("DELETE FROM","",$string);
            $string = str_ireplace("INSERT INTO","",$string);
            $string = str_ireplace("INSERT","",$string);
            $string = str_ireplace("INTO","",$string);
            $string = str_ireplace("SELECT","",$string);
            $string = str_ireplace("*","",$string);
            $string = str_ireplace("FROM","",$string);
            $string = str_ireplace("DELETE","",$string);
            $string = str_ireplace("UPDATE","",$string);
            $string = str_ireplace("SET","",$string);
            $string = str_ireplace("--","",$string);
            $string = str_ireplace("^","",$string);
            $string = str_ireplace("[","",$string);
            $string = str_ireplace("]","",$string);
            $string = str_ireplace("==","",$string);
            $string = str_ireplace("{","",$string);
            $string = str_ireplace("}","",$string);
            $string = str_ireplace("alert","",$string);
            return $string;  
        }

        protected function sweet_alert($data){
            if ($data['Alerta']=="simple"){
                $alerta = "
                    <script>
                        swal(
                            '".$data['Title']."!',
                            '".$data['Text']."!',
                            '".$data['Type']."'
                        );
                    </script>
                ";
            }elseif ($data['Alerta']=="reload") {
                $alerta = "
                    <script>
                        swal({
                            title: '".$data['Title']."',
                            text: '".$data['Text']."',
                            type: '".$data['Type']."',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            location.reload();
                        })
                    </script>
                ";
            }elseif ($data['Alerta']=="clear") {
                $alerta = "
                    <script>
                        swal({
                            title: '".$data['Title']."',
                            text: '".$data['Text']."',
                            type: '".$data['Type']."',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            $('.AjaxForm')[0].reset();
                        });
                    </script>
                ";
            }return $alerta;
        }
    }