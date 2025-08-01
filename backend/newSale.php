<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Content-Type: application/json");

    // Handle preflight request (OPTIONS)
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    include("database.php");
    $sales_data = json_decode(file_get_contents("php://input"), true);


    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $products = $sales_data["selectedItem"];
        $total_price = (float) $sales_data["total"];
        $amount_paid = (int) $sales_data["amountPaid"];
        $change = (int) $sales_data["totalChange"];
        $admin_id = (int) $sales_data["adminID"];

        $stmt = $conn->prepare("INSERT INTO sale_tbl (total_price, amount_paid, change_due, date_sold, admin_id) VALUES (?, ?, ?, NOW(), ?)");
        $stmt->bind_param("diii", $total_price, $amount_paid, $change, $admin_id);

        $stmt2 = $conn->prepare("INSERT INTO sale_item_tbl ( sale_id, product_id, quantity, price,sub_total ) VALUES (?,?,?,?,?)");
        

        if ($stmt->execute()) {
            $sale_id = $conn->insert_id;

            foreach($products as $product){
                $stmt2->bind_param("iiddd", $sale_id, $product["sale_product_id"], $product["quantity"], $product["product_price"], $product["total_price_per_item"] );
                $stmt2->execute();
            };

            echo json_encode([
            "success" => true,
            "message" => "✔️ Sales data received and processed."
            ]);
            

            $stmt->close();
            $stmt2->close();
            $conn->close();

            exit();

        } else {

            echo json_encode([
                "success" => false,
                "message" => "❌ Failed to insert sale: " . $stmt2->error
            ]);
            http_response_code(500);
            exit();
        }
    
        
    } else{
        echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
        ]);
        http_response_code(405);
        exit(); 
    }

?>