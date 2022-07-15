<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Trabalho.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $trabalho = new Trabalho($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $trabalho->descricao = $data->descricao;
    //Create post
    if($trabalho->create())
    {
        echo json_encode(
            array('message' => 'trabalho Created')
        );
    } else {
        echo json_encode(
            array('message' => 'trabalho not created'));
    }
?>