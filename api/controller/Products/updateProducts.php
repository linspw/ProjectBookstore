<?php
    include_once("../../model/Products.php");
    
    $produto = new Products();
    $id=4;
    $data = array(
        "name" => "Os 7 Hábitos das pessoas altamente eficazes",
        "description" => "Um livro que ira mudar sua vida",
        "value" => 50.0
    );
    $produto->update_product($id, $data);

?>