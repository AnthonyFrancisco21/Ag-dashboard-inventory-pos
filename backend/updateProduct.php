<?php
session_start();


if (!isset($_SESSION['admin_id'])) {
    http_response_code(403); 
    echo json_encode(["error" => "You don't have permission to access this."]);
    exit();
}

include("database.php");


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $product_id = (int) $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $old_image = $_POST['old_image'];
    $selected_category = $_POST['selected_category'];
    $final_price = $_POST['price'];
    $selected_unit = $_POST['selected_unit'];
    $admin_id = (int) $_POST['admin_id'];

    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === 0) {
        // Only unlink if it's not the default image
        if ($old_image !== "product_images/mamaclay-logo.png" && file_exists($old_image)) {
            unlink($old_image);
        }

        $image = $_FILES['new_image'];
        $tmpName = $image['tmp_name'];
        $originalName = $image['name'];
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $newName = uniqid("img_", true) . "." . strtolower($ext);
        $uploadDir = "product_images/";
        $uploadPath = $uploadDir . $newName;

        if (move_uploaded_file($tmpName, $uploadPath)) {
            $stmt = $conn->prepare("UPDATE product_tbl 
                SET product_name = ?, categories = ?, image_path = ?, unit = ?, price = ?, admin_id = ? 
                WHERE product_id = ?");
            $stmt->bind_param("ssssdii", $product_name, $selected_category, $uploadPath, $selected_unit, $final_price, $admin_id, $product_id);
            $stmt->execute();

            echo json_encode([
                "success" => true,
                "message" => "Product updated successfully",
                "path" => $uploadPath
            ]);
            exit;
        } else {
            echo json_encode(["success" => false, "message" => "Failed to move uploaded file"]);
            exit;
        }
    } 
    else {
        // No image change, just update the other fields
        $stmt = $conn->prepare("UPDATE product_tbl 
            SET product_name = ?, categories = ?, unit = ?, price = ?, admin_id = ? 
            WHERE product_id = ?");
        $stmt->bind_param("sssddi", $product_name, $selected_category, $selected_unit, $final_price, $admin_id, $product_id);
        $stmt->execute();

        echo json_encode([
            "success" => true,
            "message" => "Product updated successfully"
        ]);
        exit;
    }
}


?>