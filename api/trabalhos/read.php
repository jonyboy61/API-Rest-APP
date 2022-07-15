<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Trabalho.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $trabalho = new Trabalho($db);

    //Blog post query
    $result = $trabalho->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $trabalho_arr = array();
        $trabalho_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $trabalho_item = array(
                'id' => $id,
                'nome' => $descricao
            );

            //Push to "data"
            array_push($trabalho_arr['data'], $trabalho_item);
        }

        //Turn to JSON and output
        echo json_encode($trabalho_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Trabalho found')
    );
    }
    