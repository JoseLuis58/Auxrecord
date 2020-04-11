<?php
if ($reqAjax) {
    require_once "../models/nurseModel.php";
} else {
    require_once "./models/nurseModel.php";
}

class nurseController extends nurseModel
{

    public function add_event_controller()
    {

        $id = mainModel::clean_char($_POST['id_person-reg']);
        $name = mainModel::clean_char($_POST['nombre-reg']);
        $tel = mainModel::clean_char($_POST['telefono-reg']);
        $adress = mainModel::clean_char($_POST['dire-reg']);
        $nameAcu = mainModel::clean_char($_POST['nomAcu-reg']);

        $horaIng = date("h:i:s a");
        $sigVit = mainModel::clean_char($_POST['sign-reg']);
        $motivo = mainModel::clean_char($_POST['motivo-reg']);


        $query1 = mainModel::exec_simple_query("SELECT Id_Person FROM nursing_event WHERE Id_Person = '$id'");

        if ($query1->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "El DNI o el documento de identidad que acaba de ingresar 
                            ya se encuentra registrado en el sistema",
                "Type" => "error"
            ];
        } else {
            $dataE = [
                "Id_Person" => $id,
                "Name_Person" => $name,
                "Tel" => $tel,
                "Adress" => $adress,
                "Name_Acu" => $nameAcu,
                "Hour" => $horaIng,
                "Vital_Signs" => $sigVit,
                "Reason_Consult" => $motivo
            ];

            $saveE = nurseModel::add_event_model($dataE);

            if ($saveE->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "clear",
                    "Title" => "Evento registrado",
                    "Text" => "Los registros fueron realizados con exito en el sistema",
                    "Type" => "success"
                ];
                echo '<script> window.location.href = "' . SERVERURL . 'cligestion/" </script>';
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "No hemos podido registrar a la persona",
                    "Type" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }

    public function page_nurse_controller($page, $reg, $rol)
    {
        $page = mainModel::clean_char($page);
        $reg = mainModel::clean_char($reg);
        $rol = mainModel::clean_char($rol);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $inic = ($page > 0) ? (($page * $reg) - $reg) : 0;

        $conn = mainModel::connect();

        $datos = $conn->query("SELECT SQL_CALC_FOUND_ROWS * FROM nursing_event
                               ORDER BY Name_Person ASC LIMIT $inic,$reg");
        $pageurl = "evelist";



        $datos = $datos->fetchAll();

        $total = $conn->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npages = ceil($total / $reg);

        $table .= '
        <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Identificación</th>
                    <th class="text-center">Nombre del Paciente</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Nombre Acudiente</th>
                    <th class="text-center">Hora de Ingreso</th>
                    <th class="text-center">Signos Vitales</th>
                    <th class="text-center">Motivo</th>';
        if ($rol == "Administrador") {
            $table .= '
                        <th class="text-center">ACTUALIZAR</th>
                        ';
        }
        if ($rol == "Acudiente") {
            $table .= '
                        <th class="text-center"></th>
                        ';
        }

        $table .= '</tr>
                </thead>
                <tbody>
            
        ';

        if ($total >= 1 && $page <= $Npages) {
            $cont = $inic + 1;
            foreach ($datos as $rows) {
                $table .= '
                <tr>
                <td>' . $cont . '</td>
                <td>' . $rows['Id_Person'] . '</td>
                <td>' . $rows['Name_Person'] . '</td>
                <td>' . $rows['Tel'] . '</td>
                <td>' . $rows['Adress'] . '</td>
                <td>' . $rows['Name_Acu'] . '</td>
                <td>' . $rows['Hour'] . '</td>
                <td>' . $rows['Vital_Signs'] . '</td>
                <td>' . $rows['Reason_Consult'] . '</td>';
                if ($rol == "Administrador") {
                    $table .= '
                    <td>
                        <a href="' . SERVERURL . 'udeve/Admin/' . mainModel::encryption($rows['Id_Nursing_Even']) . '/" class="btn btn-success btn-raised btn-md">
                            <i class="zmdi zmdi-refresh"></i>
                        </a>
                    </td>
                ';
                }
                $table .= '</tr>';
                $cont++;
            }
        } else {
            if ($total >= 1) {
                $table = ' 
                    <tr>
                        <td colspan="8">
                            <a href="' . SERVERURL . $pageurl . '/" class="btn btn-sm btn-info btn-raised">
                                Haga click aca para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
            } else {
                $table = ' 
                    <tr>
                        <td colspan="8"> No hay registros en el sistema</td>
                    </tr>
                ';
            }
        }

        $table .= '</tbody></table></div>';

        if ($total >= 1 && $page <= $Npages) {

            $table .= '<nav class="text-center"><ul class="pagination pagination-sm">
                ';

            if ($page == 1) {
                $table .= '<li class="disabled"><a><i class="zmdi zmdi-arrow-left"></i></a></li>';
            } else {
                $table .= '<li class=""><a href="' . SERVERURL . $pageurl . '/' . ($page - 1) . '/"><i class="zmdi zmdi-arrow-left"></i></a></li>';
            }

            for ($i = 1; $i <= $Npages; $i++) {
                if ($page == $i) {
                    $table .= '<li class="active"><a href="' . SERVERURL . $pageurl . '/' . $i . '/">' . $i . '</a></li>';
                } else {
                    $table .= '<li><a href="' . SERVERURL . $pageurl . '/' . $i . '/">' . $i . '</a></li>';
                }
            }

            if ($page == $Npages) {
                $table .= '<li class="disabled"><a><i class="zmdi zmdi-arrow-right"></i></a></li>';
            } else {
                $table .= '<li class=""><a href="' . SERVERURL . $pageurl . '/' . ($page + 1) . '/"><i class="zmdi zmdi-arrow-right"></i></a></li>';
            }

            $table .= '</ul></nav>
                ';
        }

        return $table;
    }

    public function data_eve_controller($tipo,$code)
    {
        $code = mainModel::decryption($code);
        $tipo = mainModel::clean_char($tipo);

        return nurseModel::data_eve_model($tipo, $code);
    }

    public function delete_event_controller()
    {
        $codigo = mainModel::decryption($_POST['codigo-del']);
        $adminPrivilegio = mainModel::decryption($_POST['privilegio-admin']);

        $codigo = mainModel::clean_char($codigo);
        $adminPrivilegio = mainModel::clean_char($adminPrivilegio);

        if ($adminPrivilegio == "Administrador") {

            $DelEvento = nurseModel::delete_event_model($codigo);

            if ($DelEvento->rowCount() == 1) {
                $alerta = [
                    "Alerta" => "reload",
                    "Title" => "¡Registro Eliminado!",
                    "Text" => "El Registro fue eliminado con éxito",
                    "Type" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "¡Ocurró un error inesperado!",
                    "Text" => "Lo sentimos, no hemos podido eliminar el registro",
                    "Type" => "error"
                ];
            }
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "¡Ocurró un error inesperado!",
                "Text" => "Tu no tienes los permisos necesarios para eliminar registros del sistema",
                "Type" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }

    public function update_event_controller()
    {
        $id = mainModel::clean_char($_POST['id_person-up']);
        $name = mainModel::clean_char($_POST['nombre-up']);
        $tel = mainModel::clean_char($_POST['telefono-up']);
        $adress = mainModel::clean_char($_POST['dire-up']);
        $nameAcu = mainModel::clean_char($_POST['nomAcu-up']);

        $horaIng = mainModel::clean_char($_POST['horaIng-up']);
        $sigVit = mainModel::clean_char($_POST['sign-up']);
        $motivo = mainModel::clean_char($_POST['motivo-up']);

        $query3 = mainModel::exec_simple_query("SELECT * FROM nursing_event WHERE Id_Person='$id'");
        $DaEven = $query3->fetch();

        if ($id != $DaEven['Id_Person']) {
            $query4 = mainModel::exec_simple_query("SELECT Id_Person FROM nursing_event WHERE Id_Person='$id'");
            if ($query4->rowCount() >= 1) {
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
            "Id_Person" => $id,
            "Name_Person" => $name,
            "Tel" => $tel,
            "Adress" => $adress,
            "Name_Acu" => $nameAcu,
            "Hour" => $horaIng,
            "Vital_Signs" => $sigVit,
            "Reason_Consult" => $motivo
        ];

        if (nurseModel::update_event_model($dataUp)) {
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
    public function dataEve()
    {
        $query = mainModel::exec_simple_query("SELECT * FROM nursing_event ORDER BY Id_Nursing_Even DESC LIMIT 1");
        $query->execute();
        return $query;
    }
}
