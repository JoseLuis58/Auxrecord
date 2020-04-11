<?php
if ($reqAjax) {
    require_once "../models/medicalModel.php";
} else {
    require_once "./models/medicalModel.php";
}

class medicalController extends medicalModel
{
    public function add_medical_controller()
    {
        $dni = mainModel::clean_char($_POST['dni-his']);
        $name = mainModel::clean_char($_POST['nombre-his']);
        $tel = mainModel::clean_char($_POST['telefono-his']);
        $place = mainModel::clean_char($_POST['lugar-his']);
        $resi = mainModel::clean_char($_POST['direccion-his']);
        $patho = mainModel::clean_char($_POST['pato-his']);
        $prev = mainModel::clean_char($_POST['ante-his']);
        $food = mainModel::clean_char($_POST['cond-his']);

        $query = mainModel::exec_simple_query("SELECT DNI_Person FROM medical_history WHERE DNI_Person = '$dni'");
        if ($query->rowCount() == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Title" => "Ocurrio un error inesperado",
                "Text" => "El DNI o documento ya cuenta con un historial clinico en el sistema",
                "Type" => "error"
            ];
        } else {
            $dataM = [
                "DNI" => $dni,
                "Name" => $name,
                "Adress" => $resi,
                "Tel" => $tel,
                "Place" => $place,
                "Patho" => $patho,
                "Family" => $prev,
                "Food" => $food
            ];

            $saveM = medicalModel::add_medical_model($dataM);

            if ($saveM->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "clear",
                    "Title" => "Historial Registrado",
                    "Text" => "Los registros fueron realizados con exito en el sistema",
                    "Type" => "success"
                ];
                echo '<script> window.location.href = "' . SERVERURL . 'cuida/" </script>';
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Title" => "Ocurrio un error inesperado",
                    "Text" => "No hemos podido registrar el historial clinico",
                    "Type" => "error"
                ];
            }
        }
        return mainModel::sweet_alert($alerta);
    }

    public function page_medical_controller($page, $reg)
    {
        $page = mainModel::clean_char($page);
        $reg = mainModel::clean_char($reg);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $inic = ($page > 0) ? (($page * $reg) - $reg) : 0;

        $conn = mainModel::connect();

        $sql="SELECT SQL_CALC_FOUND_ROWS * FROM medical_history ORDER BY Name_Person ASC LIMIT $inic,$reg";
        $pageurl="clilist/";

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
                        <th class="text-center">NOMBRE DEL PACIENTE</th>
                        <th class="text-center">DIRECCIÓN</th>
                        <th class="text-center">TELÉFONO</th>
                        <th class="text-center">LUGAR DE NACIMIENTO</th>
                        <th class="text-center">PATOLOGIAS</th>
                        <th class="text-center">ANTECENDENTES PATO-FAMILIARES</th>
                        <th class="text-center">CONDICIONES ALIMENTARIAS</th>
                    </tr>
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
                    <td>' . $rows['Adress'] . '</td>
                    <td>' . $rows['Tel'] . '</td>
                    <td>' . $rows['Place'] . '</td>
                    <td>' . $rows['Pathogeny'] . '</td>
                    <td>' . $rows['Family_Previous'] . '</td>
                    <td>' . $rows['Food_Conditions'] . '</td>
                </tr>
                ';
                $cont++;
            }
        }else {
            if ($total>=1) {
                $table.='
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
        $table.='</tbody></table></div>';
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
    public function dataEve()
    {
        $query = mainModel::exec_simple_query("SELECT * FROM nursing_event ORDER BY Id_Nursing_Even DESC LIMIT 1");
        $query->execute();
        return $query;
    }
}
