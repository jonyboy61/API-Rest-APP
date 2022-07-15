<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Equipamento.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $equipamento = new Equipamento($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $equipamento->nome = $data->nome;
    $equipamento->preco = $data->preco;
    $equipamento->quantidade = $data->quantidade;
    //Create post
    if($equipamento->create())
    {
        echo json_encode(
            array('message' => 'Equipamento Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Equipamento not created'));
    }
?>