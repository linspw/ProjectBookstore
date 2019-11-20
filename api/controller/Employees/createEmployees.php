<?php
    include_once("../../model/Employee.php");
    
    $employee = new Employee();
    $employee->create_employee("100000000", "Root1", "root1@admin.com", "root");

?>