<?php
    include("database.php");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
    } else {
        $category = '';
    }

    if ($category === '') {
        $sql = "SELECT * FROM product_tbl";
        $stmt = $conn->prepare($sql);
    } else {
        $sql = "SELECT * FROM product_tbl WHERE categories = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode(["data" => $data]);
    $conn->close();
?>
