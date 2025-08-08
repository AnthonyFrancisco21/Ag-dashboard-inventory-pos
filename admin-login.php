<?php 
session_start();

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    include("backend/database.php");
    
    //Get input values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT admin_id, admin_pass FROM admin_tbl WHERE admin_email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    //Get result
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['admin_pass'])) {
            $_SESSION['admin_id'] = $admin['admin_id'];

            // Security measure: regenerate session ID
            session_regenerate_id(true);
            header("Location: http://localhost/AG_MAMACLAY_DASHBOARD/pos.php");
            echo "Login successful. Redirecting...";
            exit();
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ Username not found.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin-assets/dashboard.css">
    <link rel="stylesheet" href="admin-assets/login.css">
</head>
<body>
    
  <div class="container">
    
    <!-- Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header d-flex justify-content-center gap-2">
            <img src="admin-assets/logo.png">
            <h1 class="modal-title fs-2" id="loginLabel">AG Mamaclay Poultry Shop</h1>
          </div>
          <div class="modal-body">
            <form id="adminForm" method="POST" action="admin-login.php">
              <div class="mb-3">
                <label for="username-field" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username-field" >
              </div>

              <div class="mb-3">
                <label for="password-field" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password-field" >
              </div>

              <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-2"><?php echo $error; ?></div>
              <?php endif; ?>

              <button type="submit" class="btn btn-primary">Log In</button>

            </form>
          </div>
          <!-- <div class="modal-footer">
            
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
      document.addEventListener('DOMContentLoaded', function () {
      var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show();
    });

  </script>

</body>
</html>