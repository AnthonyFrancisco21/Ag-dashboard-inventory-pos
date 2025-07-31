<?php

    $servername = "localhost";
    $user = "root";
    $password = "";
    $db_name = "poultry_db";

    $conn = new mysqli($servername, $user, $password, $db_name);

    if($conn->connect_error){
        die("connection failed: ". $conn->connect_error);
    }

?>