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

    //Blog post query
    $result = $registo->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $registo_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $registo_item = array(
                'nome_cliente' => $nome_cliente,
                'nome_tarefa' => $nome_tarefa,
                'nome_user' => $nome_user,
                'nome_trabalho' => $nome_trabalho
            );

            //Push to "data"
            array_push($registo_arr, $registo_item);
        }

        //Turn to JSON and output
        echo json_encode($registo_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Registos found')
    );
    }
    
?>