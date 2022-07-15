<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    //Set ID to update
    $material->id = $data->id;

    //Delete post
    if($material->delete())
    {
        echo json_encode(
            array('message' => 'client Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'client not Deleted'));
    }
?>