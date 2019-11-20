<?php
    include_once("../../model/Employee.php");
    
    $employee = new Employee();
    $id=2;
    $data = array(
        "cpf" => "1000002020",
        "name" => "Root2",
        "email" => "root2@admin.com",
        "password" => "2"
    );
    $employee->update_employee($id, $data);

?>