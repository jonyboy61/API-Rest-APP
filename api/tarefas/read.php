<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Tarefa.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $tarefa = new Tarefa($db);

    //Blog post query
    $result = $tarefa->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $tarefa_arr = array();
        $tarefa_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $tarefa_item = array(
                'id' => $id,
                'descricao' => $descricao
            );

            //Push to "data"
            array_push($tarefa_arr['data'], $tarefa_item);
        }

        //Turn to JSON and output
        echo json_encode($tarefa_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Material found')
    );
    }
    
?>