<?php
    //Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $user = new User($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $user->nome = $data->nome;
    $user->username = $data->username;
    $user->email = $data->email;
    $user->password = $data->password;

    //Create post
    if($user->create())
    {
        echo json_encode(
            array('message' => 'User Created')
        );
    } else {
        echo json_encode(
            array('message' => 'User not created'));
    }
?>