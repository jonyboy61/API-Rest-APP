<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Tarefa.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $tarefa = new Tarefa($db);
    

    //Get ID
    $tarefa->id = isset($_GET['id']) ? $_GET['id'] : die();

    
    // Get post
    $tarefa->read_single();

    //Create array
    $tarefa_arr = array(
        'id' => $tarefa->id,
        'descricao' => $tarefa->descricao
    );

    //Make JSON
    print_r(json_encode($tarefa_arr));