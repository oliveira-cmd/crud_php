<?php
    class Database{
        private $conn;

        public function getConnection(){
            $this->conn = null;
            $host = '127.0.0.1';
            $db_name = 'api_php';
            $username = 'root';
            $password = 'Gabriel1304*';

            try{
                $this->conn = new PDO("mysql:host=".$host.";dbname=".$db_name, $username,$password);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception){
                echo "Erro de conexão: ". $exception->getMessage();
            }

            return $this->conn;
        }
    }


?>