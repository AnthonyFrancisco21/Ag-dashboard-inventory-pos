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

    $product_name = $_POST['product_name'];
    $selected_category = $_POST['selected_category'];
    $final_price = $_POST['final_price'];
    $selected_unit = $_POST['selected_unit'];
    $admin_id = $_POST['admin_id'];

    $uploadDir = "product_images/";

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        // Image was uploaded
        $image = $_FILES['image_file'];
        $tmpName = $image['tmp_name'];
        $originalName = $image['name'];
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $newName = uniqid("img_", true) . "." . strtolower($ext);
        $uploadPath = $uploadDir . $newName;

        if (move_uploaded_file($tmpName, $uploadPath)) {
            $image_path = $uploadPath;
        } else {
            echo json_encode(["success" => false, "message" => "Failed to move uploaded file"]);
            exit;
        }
    } else {
        // No image uploaded — use default
        $image_path = $uploadDir . "mamaclay-logo.png";
    }

    // This runs regardless if there's image or not
    $stmt = $conn->prepare("INSERT INTO product_tbl (product_name, categories, image_path, unit, price, admin_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdi", $product_name, $selected_category, $image_path, $selected_unit, $final_price, $admin_id);
    $stmt->execute();

    echo json_encode([
        "success" => true,
        "message" => "Product added successfully",
        "path" => $image_path
    ]);
    exit;
}

echo json_encode(["success" => false, "message" => "Invalid request"]);
exit;

