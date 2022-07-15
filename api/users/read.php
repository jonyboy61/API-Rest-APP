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

    //Blog post query
    $result = $user->read();

    //Get row count
    $num = $result->rowCount();

    //Check if any posts

    if($num > 0){
        $user_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_item = array(
                'id' => (int) $id,
                'nome' => $nome,
                'username' => $username,
                'email' => $email,
                'password' => $password
            );

            //Push to "data"
            array_push($user_arr, $user_item);
        }

        //Turn to JSON and output
        echo json_encode($user_arr);
    }else{
        //No posts
        echo json_encode(
            array('message' => 'No Users found')
    );
    }
    
?>