<?php
    include_once("../../config/db_config.php");
    class Stock {
        private $connection;
        public function __construct(){
            $data = new Database();
            $this->connection = $data->getConnection();
        }
        public function check_product_stock($id_product){
            $sql = "SELECT * FROM `stock` WHERE `COD_PDT` = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('i', $id_product);
            $stmt->execute();
            if($stmt->error){
                return false;
            }else {
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()) {
                    $valor = $row["avaliable_qnt_products"];
                } 
                $stmt->close();
                return $valor;

            }

        }
        public function order_buy_temp($id_employee, $id_product, $quant_product){
            $quant_avaliable = $this->check_product_stock($id_product);
            if($quant_avaliable >= $quant_product){
                echo $quant_avaliable." - ". $quant_product;
                $sql ="SELECT `value` FROM `product` WHERE `COD_PDT` = $id_product";
                $result = $this->connection->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                        $valor = $row["value"];
                    }
                }else {
                    die("Valor não achado - 0 resultados");
                }

                $price = $valor*$quant_product;
                $sql = "INSERT INTO `order_buy_temp` (`COD_ODB`, `EPY_ID`, `COD_PDT`, `price`, `quant`, `status`) VALUES (NULL, $id_employee, $id_product, $price, $quant_product, 'Vendido');";
                if ($this->connection->query($sql)){
                    $sql = "UPDATE `stock` SET `avaliable_qnt_products` = (`avaliable_qnt_products` - $quant_product), `sold_qnt_products` = (`sold_qnt_products`+$quant_product)WHERE `stock`.`COD_STK` = $id_product;";
                    if($this->connection->query($sql)){
                        echo "Compra realizada com Sucesso";
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            else{
                echo "Quantidade de produtos não disponível($quant_avaliable disponíveis de $quant_product pedido(s))";
            }
            
        }


        public function add_product($id, $quant){
            $sql = "UPDATE `stock` SET `avaliable_qnt_products` = (? + `avaliable_qnt_products`), `total_qnt_products` = (`total_qnt_products` + ?) WHERE `stock`.`COD_PDT` = ?;";

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('iii',$quant, $quant, $id);
            $stmt->execute();

            if($stmt->error){
                echo "Error: " . $sql . "<br>" . $stmt->error;

            }else {
                echo "Quantidade do produto adicionada com sucesso";
            }
            $stmt->close();
        }
        public function listAllOrder(){
            $sql ="SELECT * FROM `order_buy_temp`";
            $result = $this->connection->query($sql);
            if($result->num_rows > 0){
                $r = array();
                while($row = $result->fetch_assoc()) {
                    $r[] = $row;    
                }
                print json_encode($r);
            }else {
                echo "0 results";
            }
        }
        public function listAllStock(){
            $sql = "SELECT * FROM `stock`";
            $result = $this->connection->query($sql);
            if($result->num_rows > 0){
                $r = array();
                while($row = $result->fetch_assoc()) {
                    $r[] = $row;    
                }
                print json_encode($r);
            }else {
                echo "0 results";
            }
        }
        function __destruct(){
            $this->connection->close();
        }

    }
?>