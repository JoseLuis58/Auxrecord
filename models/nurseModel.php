<?php
if ($reqAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class nurseModel extends mainModel
{

    protected function add_event_model($data)
    {
        $sql = mainModel::connect()->prepare("INSERT INTO nursing_event(Id_Person,Name_Person,Tel,Adress,Name_Acu,Hour,Vital_Signs,Reason_Consult) 
                                VALUES(:Id_Person,:Name_Person,:Tel,:Adress,:Name_Acu,:Hour,:Vital_Signs,:Reason_Consult)");
        $sql->bindParam(":Id_Person", $data['Id_Person']);
        $sql->bindParam(":Name_Person", $data['Name_Person']);
        $sql->bindParam(":Tel", $data['Tel']);
        $sql->bindParam(":Adress", $data['Adress']);
        $sql->bindParam(":Name_Acu", $data['Name_Acu']);
        $sql->bindParam(":Hour", $data['Hour']);
        $sql->bindParam(":Vital_Signs", $data['Vital_Signs']);
        $sql->bindParam(":Reason_Consult", $data['Reason_Consult']);
        $sql->execute();
        return $sql;
    }
    protected function delete_event_model($code)
    {
        $query = mainModel::connect()->prepare("DELETE FROM nursing_event WHERE Id_Nursing_Even=:Ide");
        $query->bindParam(":Ide", $code);
        $query->execute();
        return $query;
    }

    protected function update_event_model($data)
    {
        $sql = mainModel::connect()->prepare("UPDATE nursing_event SET Id_Person=:Id_Person, Name_Person=:Name_Person, Tel=:Tel,
                    Adress=:Adress, Name_Acu=:Name_Acu, Hour=:Hour, Vital_Signs=:Vital_Signs, Reason_Consult=:Reason_Consult  WHERE Id_Person=:Id_Person");
        $sql->bindParam(":Id_Person", $data['Id_Person']);
        $sql->bindParam(":Name_Person", $data['Name_Person']);
        $sql->bindParam(":Tel", $data['Tel']);
        $sql->bindParam(":Adress", $data['Adress']);
        $sql->bindParam(":Name_Acu", $data['Name_Acu']);
        $sql->bindParam(":Hour", $data['Hour']);
        $sql->bindParam(":Vital_Signs", $data['Vital_Signs']);
        $sql->bindParam(":Reason_Consult", $data['Reason_Consult']);
        $sql->execute();
        return $sql;
    }

    protected function data_eve_model($tipo, $code)
    {
        if ($tipo == "Unico") {
            $sql = mainModel::connect()->prepare("SELECT * FROM nursing_event WHERE Id_Nursing_Even=:Code");
            $sql->bindParam(":Code", $code);
        }
        $sql->execute();
        return $sql;
    }
}
