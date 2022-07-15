<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Material.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $material = new Material($db);

    //Blog post query
    $result = $material->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $material_arr = array();
        $material_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $material_item = array(
                'id' => $id,
                'nome' => $nome,
                'serial_no' => $serialno,
                'preco' => $preco,
                'quantidade' => $quantidade
            );

            //Push to "data"
            array_push($material_arr['data'], $material_item);
        }

        //Turn to JSON and output
        echo json_encode($material_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Material found')
    );
    }
    
?>