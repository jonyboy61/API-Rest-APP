<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/RegistoEntrega.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $entrega = new RegistoEntrega($db);

    //Blog post query
    $result = $entrega->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $entrega_arr = array();
        $entrega_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $entrega_item = array(
                'id' => $id,
                'id_user' => $id_user,
                'id_cliente' => $id_cliente,
                'id_material' => $id_material,
                'id_equipamento' => $id_equipamento,
                'nota_servico' => $nota_servico
            );

            //Push to "data"
            array_push($entrega_arr['data'], $entrega_item);
        }

        //Turn to JSON and output
        echo json_encode($entrega_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Registos found')
    );
    }
    
?>