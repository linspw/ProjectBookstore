<?php
    class Database{
        protected $connection;
        private $dbhost = "localhost";
        private $dbuser = "root";
        private $dbpass = "";
        private $dbname = "db_bookstore";

        public function __construct(){
            $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if( $this->connection->connect_error ){
                die('Falha ao conectar ao Banco de Dados - ' . $this->connection->connect_error);
            }
            $this->connection->set_charset('utf8');
        }
        public function getConnection(){
            return $this->connection;
        }
    }
?>