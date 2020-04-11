<?php
if ($reqAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class medicalModel extends mainModel
{
    protected function add_medical_model($data)
    {
        $sql=mainModel::exec_simple_query("INSERT INTO medical_history(DNI_Person,Name_Person,Adress,Tel,Place,Pathogeny
        ,Family_Previous,Food_Conditions)VALUES(:DNI,:Name,:Adress,:Tel,:Place,:Patho,:Family,:Food)");
        $sql->bindParam(":DNI",$data['DNI']);
        $sql->bindParam(":Name",$data['Name']);
        $sql->bindParam(":Adress",$data['Adress']);
        $sql->bindParam(":Tel",$data['Tel']);
        $sql->bindParam(":Place",$data['Place']);
        $sql->bindParam(":Patho",$data['Patho']);
        $sql->bindParam(":Family",$data['Family']);
        $sql->bindParam(":Food",$data['Food']);
        $sql->execute();
        return $sql;
    }
}
