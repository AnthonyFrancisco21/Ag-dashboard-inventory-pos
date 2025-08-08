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


    $stmt = $conn->prepare($sql= "SELECT * FROM product_tbl WHERE is_deleted = 1" );
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$stmt) {
    echo json_encode(["error" => $conn->error]);
    exit;
}

    $deleted_data = [];

    while($row = $result->fetch_assoc()){
        $deleted_data[] = $row;
    }

    echo json_encode(["deletedData" => $deleted_data]);

    $conn->close();


?>