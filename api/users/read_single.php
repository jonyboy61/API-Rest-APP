<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instatiate blog post object
    $user = new User($db);

    //Get ID
    $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get post
    $user->read_single();

    //Create array
    $user_arr = array(
        'id' => (int) $user->id,
        'nome' => $user->nome,
        'username' => $user->username,
        'email' => $user->email,
        'password' => $user->password
    );

    //Make JSON
    print_r(json_encode($user_arr));