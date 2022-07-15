<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/RegistoEntrega.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate RegistoTrabalho object
    $registo = new RegistoEntrega($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $registo->nome_cliente = $data->nome_cliente;
    $registo->nome_equipamento = $data->nome_equipamento;
    $registo->id_user = $data->id_user;
    $registo->serial_no = $data->serial_no;



    //Create post
    if($registo->create_equipamento())
    {
        echo json_encode(
            array('message' => 'Registo Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Registo not created'));
    }
?>