<?php
    include_once("../../model/Stock.php");
    if(isset($_POST['id']) && $_POST['quant']){
        $stock = new Stock();
        $stock->add_product($_POST['id'], $_POST['quant']);
    }
       

?>