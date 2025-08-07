<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Content-Type: application/json");

    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    include("database.php");

    $data = json_decode(file_get_contents("php://input"), true);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $product_id = (int) $data["id"];
        $delete_value = (int) $data["isDelete"];

        if (isset($product_id)) {

            
            $get_stmt = $conn->prepare("UPDATE product_tbl SET is_deleted = ? WHERE product_id = ?");
            $get_stmt->bind_param("ii", $delete_value, $product_id);
            
            if($get_stmt->execute()){
                echo json_encode(["success" => true, "message" => "Product deleted."]);
            } else{
                echo json_encode(["success" => false, "message" => "Failed to delete product."]);
            }
            

            $get_stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Invalid product ID."]);
        }

        $conn->close();
    }


    
?>