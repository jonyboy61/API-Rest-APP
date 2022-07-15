<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/RegistoTrabalho.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $registo = new RegistoTrabalho($db);
    

    //Get ID
    $registo->id_user = isset($_GET['id']) ? $_GET['id'] : die();

    
    
    // Get post
     //Blog post query
     $result = $registo->readTrabalhosU();

     
     //Get row count
     $num = $result->rowCount();

    if($num > 0){
        $user_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_item = array(
                'nome_cliente' => $nome_cliente,
                'trabalho' => $nome_trabalho
            );

            //Push to "data"
            array_push($user_arr, $user_item);
        }

        //Turn to JSON and output
        echo json_encode($user_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Trabalhos found')
    );
    }