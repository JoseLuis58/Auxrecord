<?php
if ($reqAjax) {
    require_once "../models/medicalCareModel.php";
} else {
    require_once "./models/medicalCareModel.php";
}

class medicalCareController extends medicalCareModel
{

    public function add_medicalCare_controller()
    {

        $id = mainModel::clean_char($_POST['dni-reg']);
        $egreso = mainModel::clean_char($_POST['optionsEgre']);
        $observaciones = mainModel::clean_char($_POST['observaciones-reg']);
        $recomendaciones = mainModel::clean_char($_POST['rec-reg']);



        $query1 = mainModel::exec_simple_query("SELECT Id_P	 FROM medical_care WHERE Id_P = '$id'");

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
                "Id_P" => $id,
                "Egress_Hospital" => $egreso,
                "Observations" => $observaciones,
                "Recommendation" => $recomendaciones,

            ];

            $saveE = medicalCareModel::add_medicalCare_model($dataE);

            if ($saveE->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "clear",
                    "Title" => "Cuidado registrado",
                    "Text" => "Los registros fueron realizados con exito en el sistema",
                    "Type" => "success"
                ];
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

    public function page_medicalCare_controller($page, $reg, $rol)
    {
        $page = mainModel::clean_char($page);
        $reg = mainModel::clean_char($reg);
        $rol = mainModel::clean_char($rol);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $inic = ($page > 0) ? (($page * $reg) - $reg) : 0;

        $conn = mainModel::connect();

        $datos = $conn->query("SELECT SQL_CALC_FOUND_ROWS * FROM medical_care
                               ORDER BY Id_P ASC LIMIT $inic,$reg");
        $pageurl = "cuidalist";



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
                    <th class="text-center">Egreso al Hospital</th>
                    <th class="text-center">Observaciones</th>
                    <th class="text-center">Recomendaciones</th>';
        if ($rol == "Administrador") {
            $table .= '
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
                <td>' . $rows['Id_P'] . '</td>
                <td>' . $rows['Egress_Hospital'] . '</td>
                <td>' . $rows['Observations'] . '</td>
                <td>' . $rows['Recommendation'] . '</td>';
                if ($rol == "Administrador") {
                    $table .= '
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

    public function delete_medicalCare_controller()
    {
        $codigo = mainModel::decryption($_POST['codigo-del']);
        $adminPrivilegio = mainModel::decryption($_POST['privilegio-admin']);

        $codigo = mainModel::clean_char($codigo);
        $adminPrivilegio = mainModel::clean_char($adminPrivilegio);

        if ($adminPrivilegio == "Administrador") {

            $DelmedicalCare = medicalCareModel::delete_medicalCare_model($codigo);

            if ($DelmedicalCare->rowCount() == 1) {
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
}
