<?php
    include_once("../../model/Stock.php");
    
    $stock = new Stock();
    $stock->order_buy_temp(1, 2, 10);

?>