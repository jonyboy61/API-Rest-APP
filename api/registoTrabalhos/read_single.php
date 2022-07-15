<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/RegistoTrabalho.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $registo = new RegistoTrabalho($db);
    

    //Get ID
    $registo->id = isset($_GET['id']) ? $_GET['id'] : die();

    
    // Get post
    $registo->read_single();

    //Create array
    $registo_arr = array(
        'nome_cliente' => $registo->nome_cliente,
        'trabalho' => $registo->nome_trabalho,
        'tarefa' => $registo->nome_tarefa,
        'Colaborador' => $registo->nome_user
    );

    //Make JSON
    print_r(json_encode($registo_arr));