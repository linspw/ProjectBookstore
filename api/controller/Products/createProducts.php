<?php
    include_once("../../model/Products.php");
    
    if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['value'])){
        //echo "VAR:::::".$_POST['name'].$_POST['description'].$_POST['value'];
        $produto = new Products();
        $produto->create_product($_POST['name'], $_POST['description'], $_POST['value']);
    }
?>