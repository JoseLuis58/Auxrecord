<?php
if ($reqAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class acudientModel extends mainModel
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
    
}
