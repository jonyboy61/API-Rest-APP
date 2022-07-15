<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Cliente.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $client = new Cliente($db);

    //Get ID
    $client->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get post
    $client->read_single();

    //Create array
    $client_arr = array(
        'id' => $client->id,
        'nome' => $client->nome,
        'morada' => $client->morada,
        'telefone' => $client->telefone,
        'email' => $client->email,
        'nif' => $client->nif,
        'cod_postal' => $client->cod_postal,
        'latitude' => $client->latitude,
        'longitude' => $client->longitude
    );

    //Make JSON
    print_r(json_encode($client_arr));