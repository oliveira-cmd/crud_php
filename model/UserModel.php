<?php
    include_once './core/Database.php';
    class UserModel{
        private $conn;

        public function __construct()
        {
            $database = new Database();
            $this->conn = $database->getConnection();
        }

        private function prepareQuery($query){
            $sql = $this->conn->prepare($query);
            $sql->execute();

            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllUsers(){
            $query = "SELECT * FROM users";
            $result = $this->prepareQuery($query);

            return $result;
        }

        public function getUserById($id){
            $query = "SELECT * FROM users WHERE id = " . $id;
            $result = $this->prepareQuery($query);

            return $result;
        }

        public function createUser($data){
            $query = "INSERT INTO users SET `name` = '" . $data['name'] . "', email = '". $data['email'] . "', idade = ". $data['idade'];
            $result = $this->prepareQuery($query);


            return $result;
        }

        public function updateUserById($id, $data){

            $idade = !empty($data['idade']) && $data['idade'] > 0 ? $data['idade'] : 1;

            $query = "UPDATE users SET `name` =  '" . $data['name'] . "', email = '". $data['email'] . "', idade = '". $idade . "' WHERE id = " .$id;
            
            $result = $this->prepareQuery($query);

            return $result;
        }

        public function deleteUserById($id){
            $query = "DELETE FROM users WHERE id = " .$id;
            $result = $this->prepareQuery($query);

            return $result;

        }
    }


?>