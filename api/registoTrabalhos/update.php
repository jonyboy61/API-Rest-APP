<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/RegistoTrabalho.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $registo = new RegistoTrabalho($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $registo->id = $data->id;

    $registo->id_cliente = $data->id_cliente;
    $registo->id_tarefa = $data->id_tarefa;
    $registo->id_user = $data->id_user;
    $registo->id_trabalho = $data->id_trabalho;
    $registo->tipo_registo = $data->tipo_registo;
    $registo->img_servico = $data->img_servico;
    $registo->nota_servico = $data->nota_servico;

    
    //Create post
    if($registo->update())
    {
        echo json_encode(
            array('message' => 'Registo Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Registo not Updated'));
    }
?>