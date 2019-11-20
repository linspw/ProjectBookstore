<?php
    include_once("../../model/Products.php");
    
    $produto = new Products();
    $produto->create_product("A grande Aventura Masculina 2", "Uma Jornada com Deus pelas alma masculina 2", 39.9);

?>