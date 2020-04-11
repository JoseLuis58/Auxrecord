<?php
if ($reqAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class medicalCareModel extends mainModel
{

    protected function add_medicalCare_model($dataE)
    {
        $sql = mainModel::connect()->prepare("INSERT INTO medical_care(Id_P,Egress_Hospital,Observations,Recommendation) 
                                VALUES(:Id_P,:Egress_Hospital,:Observations,:Recommendation)");
        $sql->bindParam(":Id_P", $dataE['Id_P']);
        $sql->bindParam(":Egress_Hospital", $dataE['Egress_Hospital']);
        $sql->bindParam(":Observations", $dataE['Observations']);
        $sql->bindParam(":Recommendation", $dataE['Recommendation']);
        $sql->execute();
        return $sql;
    }
    protected function delete_medicalCare_model($code)
    {
        $query = mainModel::connect()->prepare("DELETE FROM medical_care WHERE Id_P=:Ide");
        $query->bindParam(":Ide", $code);
        $query->execute();
        return $query;
    }
}
