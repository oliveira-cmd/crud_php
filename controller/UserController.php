<?php
    include_once './model/UserModel.php';

    class UserController{
        private $user_model;

        public function __construct()
        {
            $this->user_model = new UserModel();
        }

        public function getAllUsers(){
            $users = $this->user_model->getAllUsers();

            echo json_encode($users);
        }

        public function getUserById($id){
            $user =  $this->user_model->getUserById($id);

            echo json_encode($user);
        }

        public function createUser($data){
            $create_user = $this->user_model->createUser($data);

            echo json_encode($create_user);

        }

        public function updateUserById($id,$data){
            $user_data['name'] = $data->name ?? '';
            $user_data['email'] = $data->email ?? '';
            $user_data['idade'] = $data->idade ?? '';
            $update_user = $this->user_model->updateUserById($id,$user_data);

            echo json_encode($update_user);
        }

        public function deleteUserById($id){
            //validar o id antes de chamar a model
            $detele_user = $this->user_model->deleteUserById($id);

            echo json_encode($detele_user);


        }
    }

?>