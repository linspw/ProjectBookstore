<?php
    include_once("../../model/Stock.php");
    if(isset($_POST['product_id'])){
        $num = intval($_POST['product_id']);
        //echo "Valor: ".$num;
        $stock = new Stock();
        $stock->order_buy_temp(1, $num, 1);
    }
    

?>