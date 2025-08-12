<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("backend/database.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT admin_id, admin_pass FROM admin_tbl WHERE admin_email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['admin_pass'])) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            session_regenerate_id(true);
            header("Location: http://localhost/AG_MAMACLAY_DASHBOARD/pos.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Username not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A.G ADMIN LOG IN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow p-4" style="max-width: 400px; width: 100%;">
    <div class="text-center mb-4">
        <img src="admin-assets/logo.png" style="width: 70px;">
        <h3 class="mt-2">AG Mamaclay Poultry Shop</h3>
    </div>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="username-field" class="form-label">Email</label>
            <input type="text" name="username" class="form-control" id="username-field" placeholder="Enter email">
        </div>

        <div class="mb-3">
            <label for="password-field" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password-field" placeholder="Enter password">
        </div>

        <div class="mb-3 text-end">
            <a href="#" id="forgotPassword" class="small">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-100">Log In</button>
    </form>

    <footer class="mt-4 text-center small text-muted">
        &copy; <span id="yearCount"></span> Mamaclay's Poultry Supply. All Rights Reserved.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

  const year = new Date().getFullYear();
  document.getElementById('yearCount').textContent = year;


</script>

<?php if (isset($error)): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: '<?php echo $error; ?>',
        confirmButtonColor: '#d33'
    });
</script>
<?php endif; ?>

</body>
</html>
