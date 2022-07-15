<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Equipamento.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $equipamento = new Equipamento($db);
    

    //Get ID
    $equipamento->id = isset($_GET['id']) ? $_GET['id'] : die();

    
    // Get post
    $equipamento->read_single();

    //Create array
    $equipamento_arr = array(
        'id' => $equipamento->id,
        'nome' => $equipamento->nome,
        'preco' => $equipamento->preco,
        'quantidade' => $equipamento->quantidade
    );

    //Make JSON
    print_r(json_encode($equipamento_arr));