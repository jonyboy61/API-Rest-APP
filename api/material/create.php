<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Material.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $material = new Material($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $material->nome = $data->nome;
    $material->serialno = $data->serialno;
    $material->preco = $data->preco;
    $material->quantidade = $data->quantidade;
    //Create post
    if($material->create())
    {
        echo json_encode(
            array('message' => 'User Created')
        );
    } else {
        echo json_encode(
            array('message' => 'User not created'));
    }
?>