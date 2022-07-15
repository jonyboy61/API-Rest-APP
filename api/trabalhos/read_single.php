<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Trabalho.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $trabalho = new Trabalho($db);
    

    //Get ID
    $trabalho->id = isset($_GET['id']) ? $_GET['id'] : die();

    
    // Get post
    $trabalho->read_single();

    //Create array
    $trabalho_arr = array(
        'id' => $trabalho->id,
        'descricao' => $trabalho->descricao
    );

    //Make JSON
    print_r(json_encode($trabalho_arr));