<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/RegistoEntrega.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $entrega = new RegistoEntrega($db);
    

    //Get ID
    $entrega->id = isset($_GET['id']) ? $_GET['id'] : die();

    
    // Get post
    $entrega->read_single();

    //Create array
    $entrega_arr = array(
        'id' => $entrega->id,
        'id_user' => $entrega->id_user,
        'id_cliente' => $entrega->id_cliente,
        'id_material' => $entrega->id_material,
        'id_equipamento' => $entrega->id_equipamento,
        'nota_servico' => $entrega->nota_servico
    );

    //Make JSON
    print_r(json_encode($entrega_arr));