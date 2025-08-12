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
    $action = $data['action'] ?? '';

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        if($action==='delete'){ //for deleting admin

            $admin_data = (int)$data['adminId'];
            $deleted_value = (int)$data['isDeleted'];

            $stmt = $conn->prepare('UPDATE admin_tbl SET is_deleted = ? WHERE admin_id = ?');
            $stmt->bind_param('ii', $deleted_value, $admin_data);

            if($stmt->execute()){
                echo json_encode(['success' => true, 'Message' => "Admin has been deleted"]);
            }else{
                echo json_encode(['success' => false, 'Message' => "Error deleting admin"]);
            }

            $stmt->close();
            $conn->close();

        }else{ //For add admin

            $admin_fname = $data['fname'];
            $admin_lname = $data['lname'];
            $admin_email = $data['adminEmail'];
            $admin_pass = $data['reEnterValue'];

            $hashedPassword = password_hash($admin_pass, PASSWORD_DEFAULT);

            $stmt = $conn->prepare('INSERT INTO admin_tbl (fname, lname, admin_email, admin_pass) VALUES (?,?,?,?)');
            $stmt->bind_param('ssss', $admin_fname, $admin_lname, $admin_email, $hashedPassword);

            if($stmt->execute()){

                echo json_encode(['success' => true, 'Message' => "Successfully added a new admin"]);

                
            } else{
                echo json_encode(['success' => false, 'message' => "Failed to add admin"]);
            }
            $conn->close();
            $stmt->close();

        }
        

    }else{
        $stmt = $conn->prepare("SELECT admin_id, fname, lname, admin_email  FROM admin_tbl WHERE is_deleted = 0");

        if($stmt->execute()){
            $result = $stmt->get_result();

            $admin_data = [];

            while($row = $result->fetch_assoc()){
                $admin_data[] = $row;
            }

            echo json_encode(['admin_data' => $admin_data]);
            $conn->close();
            $stmt->close();


        }
        else{
            echo json_encode(['Message' => 'Error fetching data']);
        }

    }



?>