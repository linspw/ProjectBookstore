<?php
    include_once("../../model/Products.php");
    
    $produto = new Products();
    $produto->delete_product(4);

?>