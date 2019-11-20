<?php
    include_once("../../model/Products.php");
    
    $produtos = new Products();

    $produtos->listAllProducts();

    
?>