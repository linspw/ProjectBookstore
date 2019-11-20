<?php
    include_once("../../config/db_config.php");
    class Products {
        private $connection;
        public function __construct(){
            $data = new Database();
            $this->connection = $data->getConnection();
        }
        public function delete_product($id){
            $sql = "DELETE FROM product WHERE COD_PDT=?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            if($stmt->error){
                echo "Error: " . $sql . "<br>" . $stmt->error;

            }else {
                echo "Produto Deletado com sucesso";
            }
            $stmt->close();
        }
        public function update_product($id, $data){
            //$sql = "UPDATE `product` SET `name` = ?, `description` = ?, `value` = ? WHERE `product`.`COD_PDT` = ?;";
            $query = "UPDATE `product` SET";
            $comma = " ";
            foreach($data as $key => $val) {
                if( ! empty($val)) {
                    $query .= $comma . $key . " = '" . mysqli_real_escape_string($this->connection,trim($val)) . "'";
                    $comma = ", ";
                }
            }
            $query = $query . "WHERE COD_PDT = '".$id."' ";

           /* $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('ssd', $name, $description, $price, $id);
            $stmt->execute();*/
            $this->connection->query($query);

            if($this->connection->error){
                echo "Error: " . $query . "<br>" . $this->connection->error;

            }else {
                echo "Produto Alterado com sucesso";
            }
            //$stmt->close();
        }


        public function create_product($name, $description, $price){
            $sql = "INSERT INTO `product` (`COD_PDT`, `name`, `description`, `value`) VALUES (NULL, ?, ?, ?);";

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('ssd', $name, $description, $price);
            $stmt->execute();

            if($stmt->error){
                echo "Error: " . $sql . "<br>" . $stmt->error;

            }else {
                $last_id = $stmt->insert_id;
                $stmt->close();
                $sql = "INSERT INTO `stock` (`COD_STK`, `COD_PDT`, `enable_product`, `avaliable_qnt_products`, `sold_qnt_products`, `total_qnt_products`) VALUES (NULL, ?, '1', '0', '0', '0');";
                $stmt = $this->connection->prepare($sql);
                $stmt->bind_param('i', $last_id);
                $stmt->execute();
                echo "Produto adicionado com sucesso: $last_id";
            }
            $stmt->close();
        }
        public function listAllProducts(){
            $sql ="SELECT * FROM `product`";
            $result = $this->connection->query($sql);
            if($result->num_rows > 0){
                $r = array();

                while($row = $result->fetch_assoc()) {
                    //echo "<p>COD_PDT: " . $row["COD_PDT"]. " - Name: " . $row["name"]. " " . $row["description"]. " " . $row["value"].  "</p>";
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