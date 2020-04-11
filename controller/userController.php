<?php
if ($reqAjax) {
    require_once "../models/userModel.php";

} else {
    require_once "./models/userModel.php";

}

class userController extends userModel
{
    public function add_user_controller()
    {
        $dni = mainModel::clean_char($_POST['dni-reg']);
        $name = mainModel::clean_char($_POST['nombre-reg']);
        $lastName = mainModel::clean_char($_POST['apellido-reg']);
        $tel = mainModel::clean_char($_POST['telefono-reg']);
        $adress = mainModel::clean_char($_POST['dire-reg']);
        $genre = mainModel::clean_char($_POST['optionsGenero']);

        $user = mainModel::clean_char($_POST['usuario-reg']);
        $password = $dni;
        $password2 = $dni;
        $email = mainModel::clean_char($_POST['email-reg']);
        $role = mainModel::clean_char($_POST['optionsPrivilegio']);
        $grado = mainModel::clean_char($_POST['grado-reg']);
        $direcG = mainModel::clean_char($_POST['direcG-reg']);

        if ($genre == "Masculino") {
            $photo = "TeacherMaleAvatar.png";
        } else {
            $photo = "TeacherFemaleAvatar.png";
        }

        /////////////////PRUEBA//////////////////

        if($role == "Estudiante") {
            $query1 = mainModel::exec_simple_query("SELECT DNI_Person FROM Person WHERE DNI_Person = '$dni'");
            if ($query1->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "El DNI o el documento de identidad que acaba de ingresar 
                        ya se encuentra registrado en el sistema",
                    "Type" => "error"
                ];
            } else {
                    $query3 = mainModel::exec_simple_query("SELECT Grade FROM studient WHERE Grade = '$grado'");
                    if ($query3->rowCount() >= 1) {
                        $alerta = [
                            "Alerta" => "simple",
                            "Title" => "Ocurrio un error inesperado",
                            "Text" => "El usuario que ha ingresado ya esta siendo utilizado",
                            "Type" => "error"
                        ];
                    } else {
                        $query4 = mainModel::exec_simple_query("SELECT Id FROM user");
                        $numero = ($query4->rowCount()) + 1;
                        $code = mainModel::random_code("AC", 7, $numero);

                        $dataC = [
                            "Id_Studient" => $dni,
                            "Grade" => $grado,
                            "Direc_Grade" => $direcG,
                        ];
            
                        $saveC = userModel::add_student_model($dataC);

                        if ($saveC->rowCount() >= 1) {
                            $dataP = [
                                "Rol" => $role,
                                "Name_Person" => $name,
                                "Last_Person" => $lastName,
                                "DNI_Person" => $dni,
                                "Tel_Person" => $tel,
                                "Adress" => $adress,
                                "Code_Person" => $code
                            ];
                            
                            $saveU = userModel::add_user_model($dataP);

                            if ($saveU->rowCount() >= 1) {
                                $alerta = [
                                    "Alerta" => "clear",
                                    "Title" => "Persona registrada",
                                    "Text" => "Los registros fueron realizados con exito en el sistema",
                                    "Type" => "success"
                                ];
                            } else {
                                mainModel::delete_user($code);
                                $alerta = [
                                    "Alerta" => "simple",
                                    "Title" => "Ocurrio un error inesperado",
                                    "Text" => "No hemos podido registrar a la persona",
                                    "Type" => "error"
                                ];
                            }
                        } else {
                            $alerta = [
                                "Alerta" => "simple",
                                "Title" => "Ocurrio un error inesperado",
                                "Text" => "No hemos podido registrar el usuario",
                                "Type" => "error"
                            ];
                        }
                    }
                
            }
         }else {
            
        
        ////////////////END PRUEBA////////////////////
        
        if ($password != $password2) {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "Las contraseñas no coinciden",
                "Type" => "error"
            ];
        } else {
            $query1 = mainModel::exec_simple_query("SELECT DNI_Person FROM Person WHERE DNI_Person = '$dni'");
            if ($query1->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "El DNI o el documento de identidad que acaba de ingresar 
                        ya se encuentra registrado en el sistema",
                    "Type" => "error"
                ];
            } else {
                if ($email != "") {
                    $query2 = mainModel::exec_simple_query("SELECT Email FROM user WHERE Email = '$email'");
                    $eu = $query2->rowCount();
                } else {
                    $eu = 0;
                }
                if ($eu >= 1) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Title" => "Ocurrio un error inesperado",
                        "Text" => "El email que ha ingresado ya esta siendo utilizado",
                        "Type" => "error"
                    ];
                } else {
                    $query3 = mainModel::exec_simple_query("SELECT username FROM user WHERE username = '$user'");
                    if ($query3->rowCount() >= 1) {
                        $alerta = [
                            "Alerta" => "simple",
                            "Title" => "Ocurrio un error inesperado",
                            "Text" => "El usuario que ha ingresado ya esta siendo utilizado",
                            "Type" => "error"
                        ];
                    } else {
                        $query4 = mainModel::exec_simple_query("SELECT Id FROM user");
                        $numero = ($query4->rowCount()) + 1;
                        $code = mainModel::random_code("AC", 7, $numero);

                        $dataC = [
                            "Rol" => $role,
                            "Username" => $user,
                            "Password" => $password,
                            "Email" => $email,
                            "Photo" => $photo,
                            "Gender" => $genre,
                            "Code_Account" => $code
                        ];
                        require "../models/enviarCorreo/enviar.php";
                        $saveC = mainModel::add_user($dataC);

                        if ($saveC->rowCount() >= 1) {
                            $dataP = [
                                "Rol" => $role,
                                "Name_Person" => $name,
                                "Last_Person" => $lastName,
                                "DNI_Person" => $dni,
                                "Tel_Person" => $tel,
                                "Adress" => $adress,
                                "Code_Person" => $code
                            ];

                            $saveU = userModel::add_user_model($dataP);
                            
                            if ($saveU->rowCount() >= 1) {
                                $alerta = [
                                    "Alerta" => "clear",
                                    "Title" => "Persona registrada",
                                    "Text" => "Los registros fueron realizados con exito en el sistema",
                                    "Type" => "success"
                                ];
                            } else {
                                mainModel::delete_user($code);
                                $alerta = [
                                    "Alerta" => "simple",
                                    "Title" => "Ocurrio un error inesperado",
                                    "Text" => "No hemos podido registrar a la persona",
                                    "Type" => "error"
                                ];
                            }
                        } else {
                            $alerta = [
                                "Alerta" => "simple",
                                "Title" => "Ocurrio un error inesperado",
                                "Text" => "No hemos podido registrar el usuario",
                                "Type" => "error"
                            ];
                        }
                    }
                }
            }
        }
    }
        return mainModel::sweet_alert($alerta);
    }

    public function page_user_controller($page, $reg, $rol, $code, $search)
    {
        $page = mainModel::clean_char($page);
        $reg = mainModel::clean_char($reg);
        $rol = mainModel::clean_char($rol);
        $code = mainModel::clean_char($code);
        $search = mainModel::clean_char($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $inic = ($page > 0) ? (($page * $reg) - $reg) : 0;

        if (isset($search) && $search != "") {
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM person WHERE ((Code_Person !='$code' AND Id_Person!=1) 
                    AND (DNI_Person LIKE '%$search%' OR Last_Person LIKE '%$search%' OR Name_Person LIKE '%$search%')) 
                    ORDER BY Name_Person ASC LIMIT $inic,$reg";
            $pageurl = "persearch/";
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM person WHERE Code_Person !='$code' AND Id_Person!=1
                ORDER BY Name_Person ASC LIMIT $inic,$reg";
            $pageurl = "perlist";
        }


        $conn = mainModel::connect();

        $datos = $conn->query($sql);

        $datos = $datos->fetchAll();

        $total = $conn->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npage = ceil($total / $reg);

        $table .= '
            <div class="table-responsive">
                <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">DNI</th>
                        <th class="text-center">NOMBRES</th>
                        <th class="text-center">APELLIDOS</th>
                        <th class="text-center">TELÉFONO</th>
                        <th class="text-center">DIRECCION</th>
                        <th class="text-center">Rol</th>';
        if ($rol == "Administrador") {
            $table .= '
                        <th class="text-center">A. CUENTA</th>
                        <th class="text-center">A. DATOS</th>
                        ';
        }
        if ($rol == "Acudiente") {
            $table .= '
                        <th class="text-center">A. DATOS</th>
                        ';
        }


        $table .= '</tr>
                    </thead>
                    <tbody>
                
            ';

        if ($total >= 1 && $page <= $Npage) {
            $cont = $inic + 1;
            foreach ($datos as $rows) {
                $table .= '
                        <tr>
                            <td>' . $cont . '</td>
                            <td>' . $rows['DNI_Person'] . '</td>
                            <td>' . $rows['Name_Person'] . '</td>
                            <td>' . $rows['Last_Person'] . '</td>
                            <td>' . $rows['Tel_Person'] . '</td>
                            <td>' . $rows['Adress'] . '</td>
                            <td>' . $rows['Rol'] . '</td>';
                if ($rol == "Administrador") {
                    $table .= '
                                    <td>
                                        <a href="' . SERVERURL . 'udper/Acu/' . mainModel::encryption($rows['Code_Person']) . '/" class="btn btn-success btn-raised btn-xs">
                                            <i class="zmdi zmdi-refresh"></i>
                                        </a>
                                    </td>
                                    <td>
                                    <a href="' . SERVERURL . 'dataper/Acu/' . mainModel::encryption($rows['Code_Person']) . '/" class="btn btn-success btn-raised btn-xs">
                                        <i class="zmdi zmdi-refresh"></i>
                                    </a>
                                    </td>
                                    ';
                }
                if ($rol == "Acudiente") {
                    $table .= '
                                    <td>
                                    <a href="' . SERVERURL . 'dataper/Estu/' . mainModel::encryption($rows['Code_Person']) . '/" class="btn btn-success btn-raised btn-xs">
                                        <i class="zmdi zmdi-refresh"></i>
                                    </a>
                                    </td>
                                ';
                }
                $table .= '
                        </tr>
                    ';
                $cont++;
            }
        } else {
            if ($total >= 1) {
                $table = ' 
                    <tr>
                        <td colspan="5">
                            <a href="' . SERVERURL . $pageurl . '/" class="btn btn-sm btn-info btn-raised">
                                Haga click aca para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            } else {
                $table = ' 
                    <tr>
                        <td colspan="5"> No hay registros en el sistema</td>
                    </tr>
                ';
            }
        }

        $table .= '</tbody></table></div>';

        if ($total >= 1 && $page <= $Npage) {

            $table .= '<nav class="text-center"><ul class="pagination pagination-sm">
                ';

            if ($page == 1) {
                $table .= '<li class="disabled"><a><i class="zmdi zmdi-arrow-left"></i></a></li>';
            } else {
                $table .= '<li class=""><a href="' . SERVERURL . $pageurl . '/' . ($page - 1) . '/"><i class="zmdi zmdi-arrow-left"></i></a></li>';
            }

            for ($i = 1; $i <= $Npage; $i++) {
                if ($page == $i) {
                    $table .= '<li class="active"><a href="' . SERVERURL . $pageurl . '/' . $i . '/">' . $i . '</a></li>';
                } else {
                    $table .= '<li><a href="' . SERVERURL . $pageurl . '/' . $i . '/">' . $i . '</a></li>';
                }
            }

            if ($page == $Npage) {
                $table .= '<li class="disabled"><a><i class="zmdi zmdi-arrow-right"></i></a></li>';
            } else {
                $table .= '<li class=""><a href="' . SERVERURL . $pageurl . '/' . ($page + 1) . '/"><i class="zmdi zmdi-arrow-right"></i></a></li>';
            }

            $table .= '</ul></nav>
                ';
        }

        return $table;
    }

    public function delete_user_controller()
    {
        $code = mainModel::decryption($_POST['Code-Del']);
        $adminrol = mainModel::decryption($_POST['Rol-Del']);

        $code = mainModel::clean_char($code);
        $adminrol = mainModel::clean_char($adminrol);

        if ($adminrol == "Administrador") {
            $sql = mainModel::exec_simple_query("SELECT Id FROM person WHERE Id_Person='$code'");
            $dataP = $sql->fetch();
            if ($dataP['Id_Person'] != 1) {
                $Delp = userModel::delete_user_model($code);
                mainModel::delete_bitacora($code);
                if ($Delp->rowCount() >= 1) {
                    $DelU = mainModel::delete_user($code);
                    if ($DelU->rowCount() >= 1) {
                        $alerta = [
                            "Alerta" => "reload",
                            "Title" => "Persona eliminado",
                            "Text" => "Se ha eliminado la persona correctamente de todo el sistema",
                            "Type" => "success"
                        ];
                    } else {
                        $alerta = [
                            "Alerta" => "simple",
                            "Title" => "Ocurrio un error inesperado",
                            "Text" => "No podemos eliminar este usuario en este momento",
                            "Type" => "error"
                        ];
                    }
                } else {
                    $alerta = [
                        "Alerta" => "simple",
                        "Title" => "Ocurrio un error inesperado",
                        "Text" => "No podemos eliminar esta persona en este momento",
                        "Type" => "error"
                    ];
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "No podemos eliminar el administrador principal del sistema",
                    "Type" => "error"
                ];
            }
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "No hemos podido eliminar a la persona",
                "Type" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }

    public function data_user_controller($tipo, $code)
    {
        $code = mainModel::decryption($code);
        $tipo = mainModel::clean_char($tipo);

        return userModel::data_user_model($tipo, $code);
    }

    public function update_user_controller()
    {
        $account = mainModel::decryption($_POST['cuenta-up']);

        $dni = mainModel::clean_char($_POST['dni-up']);
        $name = mainModel::clean_char($_POST['nombre-up']);
        $last = mainModel::clean_char($_POST['apellido-up']);
        $tele = mainModel::clean_char($_POST['telefono-up']);
        $adres = mainModel::clean_char($_POST['dire-reg']);

        $sql = mainModel::exec_simple_query("SELECT * FROM person WHERE Code_Person='$account'");
        $DAdmin = $sql->fetch();

        if ($dni != $DAdmin['DNI_Person']) {
            $query1 = mainModel::exec_simple_query("SELECT DNI_Person FROM person WHERE DNI_Person='$dni'");
            if ($query1->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "El DNI que acaba de ingresar ya se encuentra registrado en el sistema",
                    "Type" => "error"
                ];
                return mainModel::sweet_alert($alerta);
                exit();
            }
        }
        $dataUp = [
            "DNI" => $dni,
            "Name" => $name,
            "Last" => $last,
            "Tel" => $tele,
            "Adress" => $adres,
            "Code" => $account
        ];

        if (userModel::update_user_model($dataUp)) {
            $alerta = [
                "Alerta" => "reload",
                "Title" => "Datos Actualizados",
                "Text" => "Los datos han sido actualizados satisfactoriamente",
                "Type" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "No hemos podido actualizar tus datos, por favor intente nuevamente",
                "Type" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }
}
