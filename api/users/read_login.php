<?php

header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instatiate user object
$user = new User($db);

$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] :die();



$stmt = $user->login();

if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_arr = array(
        "status" => true,
        "message" => "Login Sucessful",
        "id" => $row['id'],
        "username" => $row['username'],
        "email" => $row['email'],
        "nome" => $row['nome']);
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Username ou password inválido",
    );
}

echo json_encode($user_arr);