<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Equipamento.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $equipamento = new Equipamento($db);

    //Blog post query
    $result = $equipamento->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $equipamento_arr = array();
        $equipamento_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $equipamento_item = array(
                'id' => $id,
                'nome' => $nome,
                'preco' => $preco,
                'quantidade' => $quantidade
            );

            //Push to "data"
            array_push($equipamento_arr['data'], $equipamento_item);
        }

        //Turn to JSON and output
        echo json_encode($equipamento_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Material found')
    );
    }
    