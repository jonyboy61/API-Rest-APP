<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/RegistoTrabalho.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $registo = new RegistoTrabalho($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $registo->id = $data->id;

    //Delete post
    if($registo->delete())
    {
        echo json_encode(
            array('message' => 'Registo Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Registo not Deleted'));
    }
?>