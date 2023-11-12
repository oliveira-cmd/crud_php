<?php
    include_once './core/Database.php';
    class ProductModel{
        private $conn;

        public function __construct(){
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        private function prepareQuery($query){
            $sql = $this->conn->prepare($query);
            $sql->execute();

            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllProducts(){
            $query = "SELECT * FROM product";

            $results = $this->prepareQuery($query);


            return $results;

        }

        public function createProduct($data){
            $query = "INSERT INTO product SET `name` = '".$data->name."', description = '".$data->description."', price = '".$data->price."', user_log = '".$data->user."', date_added = NOW(), date_modified = NOW()";


            $results = $this->prepareQuery($query);

            return $results;
        }

        public function verifyProduct($sku){
            $query = "SELECT id FROM product WHERE sku = ".$sku;

            $result = $this->prepareQuery($query);

            return $result;
        }
    }


?>