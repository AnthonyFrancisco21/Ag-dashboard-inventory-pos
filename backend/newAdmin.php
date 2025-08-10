<?php

    session_start();

    if(!isset($_SESSION['admin_id'])){
        if (!isset($_SESSION['admin_id'])) {
        http_response_code(403); 
        echo json_encode(["error" => "You don't have permission to access this."]);
        exit();
    }
    }

    include('database.php');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Content-Type: application/json");

    $admin_data = json_decode(file_get_contents("php://input"), true);

    if($_REQUEST_METHOD == "POST"){
        $admin_fname = $_admin_data['fname'];
        echo " {$admin_fname}";
    }else{
        echo json_encode(['error' => 'error request']);
    }




?>