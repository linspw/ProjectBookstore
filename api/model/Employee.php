<?php
    include_once("../../config/db_config.php");
    class Employee {
        private $connection;
        public function __construct(){
            $data = new Database();
            $this->connection = $data->getConnection();
        }
        public function delete_employee($id){
            $sql = "DELETE FROM employee WHERE EPY_ID=?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            if($stmt->error){
                echo "Error: " . $sql . "<br>" . $stmt->error;

            }else {
                echo "Funcionario Deletado com sucesso";
            }
            $stmt->close();
        }
        public function update_employee($id, $data){
            $query = "UPDATE `employee` SET";
            $comma = " ";
            foreach($data as $key => $val) {
                if( ! empty($val)) {
                    $query .= $comma . $key . " = '" . mysqli_real_escape_string($this->connection,trim($val)) . "'";
                    $comma = ", ";
                }
            }
            $query = $query . "WHERE EPY_ID = '".$id."' ";
            $this->connection->query($query);

            if($this->connection->error){
                echo "Error: " . $query . "<br>" . $this->connection->error;

            }else {
                echo "Funcionario Alterado com sucesso";
            }
        }


        public function create_employee($cpf, $name, $email, $password){
            $sql = "INSERT INTO `employee` (`EPY_ID`, `cpf`, `name`, `email`, `password`) VALUES (NULL, ?, ?, ?, ?);";

            if($stmt = $this->connection->prepare($sql)){
                $stmt->bind_param('ssss', $cpf, $name, $email, $password);
                $stmt->execute();

                if($stmt->error){
                    echo "Error: " . $sql . "<br>" . $stmt->error;

                }else {
                    echo "Funcionario adicionado com sucesso";
                }
                $stmt->close();
            }else{
                echo "Error: " . $sql . "<br>" . $this->connection->error;
            }
            
        }
        public function listAllEmployee(){
            $sql ="SELECT * FROM `employee`";
            $result = $this->connection->query($sql);
            if($result->num_rows > 0){
                $r = array();
                while($row = $result->fetch_assoc()) {
                    //echo "<p>EPY_ID: " . $row["EPY_ID"]." - Cpf: " . $row["cpf"]. " - Name: " . $row["name"]. " " . $row["email"]. " " . $row["password"].  "</p>";
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