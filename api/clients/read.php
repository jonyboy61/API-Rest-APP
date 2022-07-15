<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Cliente.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $client = new Cliente($db);

    //Blog post query
    $result = $client->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $client_arr = array();
        $client_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $client_item = array(
                'id' => $id,
                'nome' => $nome,
                'morada' => $morada,
                'telefone' => $telefone,
                'email' => $email,
                'nif' => $nif,
                'cod_postal' => $cod_postal,
                'latitude' => $latitude,
                'longitude' => $longitude
            );

            //Push to "data"
            array_push($client_arr['data'], $client_item);
        }

        //Turn to JSON and output
        echo json_encode($client_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Clients found')
    );
    }
    
?>