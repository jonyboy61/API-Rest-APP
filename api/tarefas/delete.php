<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Tarefa.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $tarefa = new Tarefa($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $tarefa->id = $data->id;

    //Delete post
    if($tarefa->delete())
    {
        echo json_encode(
            array('message' => 'Tarefa Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Tarefa not Deleted'));
    }
?>