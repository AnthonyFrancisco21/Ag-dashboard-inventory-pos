<?php
header('Content-Type: application/json');
include ('database.php');

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['selectedAdminId'];
$fname = $data['admin_fname'];
$lname = $data['admin_lname'];
$email = $data['admin_email'];
$oldPass = $data['admin_old_password'] ?? '';
$newPass = $data['admin_new_password'] ?? '';

// Check if password change is requested
if (!empty($oldPass) && !empty($newPass)) {
    // Get current password hash
    $stmt = $conn->prepare("SELECT admin_pass FROM admin_tbl WHERE admin_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if (!$admin || !password_verify($oldPass, $admin['admin_pass'])) {
        echo json_encode(["success" => false, "message" => "Old password is incorrect"]);
        exit;
    }

    // Hash the new password
    $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE admin_tbl SET fname = ?, lname = ?, admin_email = ?, admin_pass = ? WHERE admin_id = ?");
    $stmt->bind_param("ssssi", $fname, $lname, $email, $hashedPass, $id);

} else {
    // No password change
    $stmt = $conn->prepare("UPDATE admin_tbl SET fname = ?, lname = ?, admin_email = ? WHERE admin_id = ?");
    $stmt->bind_param("sssi", $fname, $lname, $email, $id);
}

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Admin updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating admin"]);
}
?>
