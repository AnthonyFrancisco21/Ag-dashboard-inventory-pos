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

    $sale_query = "SELECT * FROM sale_tbl";

    $sale_per_product_query = "SELECT * FROM sale_item_tbl";

    $stmt = $conn->prepare($sale_query);
    $stmt2 = $conn->prepare($sale_per_product_query);

    $stmt->execute();
    $sale_result = $stmt->get_result();

    $stmt2->execute();
    $sale_per_product_result = $stmt2->get_result();

    $sales = [];
    $sales_per_product = [];

    while($row = $sale_result->fetch_assoc()){
        $sales[] = $row;
    }

    while($row = $sale_per_product_result -> fetch_assoc()){
        $sale_per_product[] = $row;
    }

    echo json_encode([
            "Sales" => $sales,
            "Sales_per_product" => $sale_per_product
    ])




?>