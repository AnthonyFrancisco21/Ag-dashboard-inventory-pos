<?php
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include("database.php");

    if(!isset($_SESSION['admin_id'])){

        http_response_code(403); 
        echo json_encode(["error" => "You don't have permission to access this."]);
        exit(); 
        
    }
    $data = json_decode(file_get_contents("php://input"), true);

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $lname = $data['first_name'];
        $fname = $data['last_name'];
        $pass = $data['password'];


        $stmt = $conn->prepare('INSERT INTO admin_tbl (fname, lname, admin_pass)');
        $stmt->bind_param('ssss', $lname, $fname, $pass);

        if($stmt->execute()){

            echo json_encode(['Success' => true, 'Message' => "Successfully added a new admin"]);

            $stmt->close();
        }

    }else{
        $stmt = $conn->prepare("SELECT admin_id, fname, lname, admin_email  FROM admin_tbl");

        if($stmt->execute()){
            $result = $stmt->get_result();

            $admin_data = [];

            while($row = $result->fetch_assoc()){
                $admin_data[] = $row;
            }

            echo json_encode(['admin_data' => $admin_data]);

            $stmt->close();


        }
        else{
            echo json_encode(['Message' => 'Error fetching data']);
        }

    }

    //REPEAT FULL OF ERROR


?>