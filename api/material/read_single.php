<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Material.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $material = new Material($db);
    

    //Get ID
    $material->id = isset($_GET['id']) ? $_GET['id'] : die();

    
    // Get post
    $material->read_single();

    //Create array
    $material_arr = array(
        'id' => $material->id,
        'nome' => $material->nome,
        'serial_no' => $material->serialno,
        'preco' => $material->preco,
        'quantidade' => $material->quantidade
    );

    //Make JSON
    print_r(json_encode($material_arr));