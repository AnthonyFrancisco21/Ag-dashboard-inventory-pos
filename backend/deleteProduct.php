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

        if (isset($product_id)) {

            
            $get_stmt = $conn->prepare("SELECT image_path FROM product_tbl WHERE product_id = ?");
            $get_stmt->bind_param("i", $product_id);
            $get_stmt->execute();
            $result = $get_stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $image_path = $row['image_path'];

                
                $stmt = $conn->prepare("DELETE FROM product_tbl WHERE product_id = ?");
                $stmt->bind_param("i", $product_id);

                if ($stmt->execute()) {
                    
                    if ($image_path && file_exists($image_path)) {
                        unlink($image_path);
                    }

                    echo json_encode(["success" => true, "message" => "Deleted successfully."]);
                } else {
                    echo json_encode(["success" => false, "message" => $stmt->error]);
                }

                $stmt->close();
            } else {
                echo json_encode(["success" => false, "message" => "Product not found."]);
            }

            $get_stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Invalid product ID."]);
        }

        $conn->close();
    }


    
?>