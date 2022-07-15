<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/Cliente.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $client = new Cliente($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $client->id = $data->id;

    $client->nome = $data->nome;
    $client->morada = $data->morada;
    $client->telefone = $data->telefone;
    $client->email = $data->email;
    $client->nif = $data->nif;
    $client->cod_postal = $data->cod_postal;
    $client->latitude = $data->latitude;
    $client->longitude = $data->longitude;

    //Create post
    if($client->update())
    {
        echo json_encode(
            array('message' => 'User Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'User not Updated'));
    }
?>