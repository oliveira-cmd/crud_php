<?php

    include './controller/UserController.php';
    include './controller/ProductController.php';
    $user_controller = new UserController();
    $product_controller = new ProductController();
    $request_uri = explode('?', $_SERVER['REQUEST_URI'],2)[0];
    $route = explode('/',$request_uri)[2];

    $request_method = $_SERVER['REQUEST_METHOD'];
    
    if($request_method){
        // crud de usuarios
        if($route == 'user'){
            if($request_method == 'GET'){
    
                if($request_uri[0] == '/api/user'){
                    $user_controller->getAllUsers();
                }else if(preg_match('/\/api\/user\/(\d+)/', $request_uri[0], $matches)){
    
                    $user_controller->getUserById($matches[1]);
                }
            } else if($request_method == 'POST' && $request_uri[0] == '/api/user'){
                $data = json_decode(file_get_contents('php://input'), true);
    
                $user_controller->createUser($data);
            } else if($request_method == 'PUT'){
                if(preg_match('/\/api\/user\/(\d+)/', $request_uri[0], $matches)){
                    $data = json_decode(file_get_contents('php://input', true));
                    $user_controller->updateUserById($matches[1], $data);
                }
            } else if($request_method == "DELETE"){
                if(preg_match('/\/api\/user\/(\d+)/', $request_uri[0], $matches)){
                    $user_controller->deleteUserById($matches[1]);
                }
            } else {
                echo 'Erro Metodo não reconhecido';
            }
        } else if($route == 'product'){
            if($request_method == 'GET'){
                $product_controller->getAllProducts();
            } else if($request_method == 'POST'){
                $post_data = file_get_contents(('php://input'), true);
                $data = json_decode($post_data);

                $product_controller->createProduct($data);
            }
        }

    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Pagina não encontrada';
    }

?>