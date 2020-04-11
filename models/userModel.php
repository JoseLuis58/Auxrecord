<?php
if ($reqAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class userModel extends mainModel
{
    protected function add_user_model($data)
    {
        $sql = mainModel::connect()->prepare("INSERT INTO person(DNI_Person,Name_Person,Last_Person,
                                Tel_Person,Adress,Rol,Code_Person) 
                                VALUES(:DNI_Person,:Name_Person,:Last_Person,:Tel_Person,:Adress,:Rol,:Code_Person)");
        $sql->bindParam(":DNI_Person", $data['DNI_Person']);
        $sql->bindParam(":Name_Person", $data['Name_Person']);
        $sql->bindParam(":Last_Person", $data['Last_Person']);
        $sql->bindParam(":Tel_Person", $data['Tel_Person']);
        $sql->bindParam(":Adress", $data['Adress']);
        $sql->bindParam(":Rol", $data['Rol']);
        $sql->bindParam(":Code_Person", $data['Code_Person']);
        $sql->execute();
        return $sql;
    }
    
    protected function add_student_model($data)
    {
        $sql = mainModel::connect()->prepare("INSERT INTO studient(Id_Studient,Grade,Direc_Grade) 
                                VALUES(:Id_Studient,:Grade,:Direc_Grade)");
        $sql->bindParam(":Id_Studient", $data['Id_Studient']);
        $sql->bindParam(":Grade", $data['Grade']);
        $sql->bindParam(":Direc_Grade", $data['Direc_Grade']);
        $sql->execute();
        return $sql;
    }

    protected function delete_user_model($code)
    {
        $sql = mainModel::connect()->prepare("DELETE FROM person WHERE Code_Person=:Code");
        $sql->bindParam(":Code", $code);
        $sql->execute();
        return $sql;
    }

    protected function data_user_model($tipo, $code)
    {
        if ($tipo == "Unico") {
            $sql = mainModel::connect()->prepare("SELECT * FROM person WHERE Code_Person=:Code");
            $sql->bindParam(":Code", $code);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel::connect()->prepare("SELECT Id_Person FROM person WHERE Id_Person!='1'");
        }
        $sql->execute();
        return $sql;
    }

    protected function update_user_model($data)
    {
        $sql = mainModel::connect()->prepare("UPDATE person SET DNI_Person=:DNI, Name_Person=:Name, Last_Person=:Last,
                    Tel_Person=:Tel, Adress=:Adress WHERE Code_Person=:Code");
        $sql->bindParam(":DNI", $data['DNI']);
        $sql->bindParam(":Name", $data['Name']);
        $sql->bindParam(":Last", $data['Last']);
        $sql->bindParam(":Tel", $data['Tel']);
        $sql->bindParam(":Adress", $data['Adress']);
        $sql->bindParam(":Code", $data['Code']);
        $sql->execute();
        return $sql;
    }
}
