<?php
    include_once './model/ProductModel.php';
    class ProductController{
        private $product_model;

        public function __construct()
        {
            $this->product_model = new ProductModel();
        }

        public function getAllProducts(){
            $products = $this->product_model->getAllProducts();

            echo json_encode($products);
        }

        public function createProduct($data){

            $product_existing = $this->verifyProductExisting($data->sku);

            if($product_existing){
                $response = [
                    'message'   => 'product already registered'
                ];
            } else {
                $this->product_model->createProduct($data);
                $response = [
                    'message'   => 'successfully created product'
                ];
            }


            echo json_encode($response);
        }

        private function verifyProductExisting($sku){
            $verify_product = $this->product_model->verifyProduct($sku);

            if(empty($verify_product)){
                return true;
            } else {
                return false;
            }
        }
    }

?>