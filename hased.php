<?php 

$password = "dummyadmin123"; // plain text password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;

?>