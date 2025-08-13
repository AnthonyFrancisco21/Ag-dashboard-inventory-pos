<?php 

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="admin-assets/logo.png">
    <link rel="stylesheet" href="admin-assets/dashboard.css">
    <link rel="stylesheet" href="admin-assets/admin-settings.css">
</head>

<body data-admin-id="<?= $_SESSION['admin_id']; ?>" data-admin-fname = "<?= $_SESSION['admin_fname']?>">

    <!-- Alerts -->
    <div id="liveAlertPlaceholder"></div>

    <div class="container-fluid d-flex m-0 p-0 min-vh-100">

        <aside class="sidebar-section shadow">
            <div class="sidebar-wrapper">
                <header class="sidebar-header">
                    <img src="admin-assets/logo.png">
                    <h1>Welcome, <?= htmlspecialchars($_SESSION['admin_fname']); ?></h1>
                </header>
    
                <main class="sidebar-main">
                    
                    <ul>
                        
                        <li><a href="pos.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M620-163 450-333l56-56 114 114 226-226 56 56-282 282Zm220-397h-80v-200h-80v120H280v-120h-80v560h240v80H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v200ZM480-760q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/></svg>Add Sales</a></li>

                        <li><a href="admin-products-management.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg>Manage Products</a></li>

                        <li><a href="statistics.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>Statistics</a></li>

                        <li><a href="admin-settings.php" class="sidebar-active-page"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>Admin Settings</a></li>
                    </ul>

                </main>
    
                <footer class="sidebar-footer">
                    <button class="log-out-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--tertiary-color)"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>Log out</button>
                </footer>
            </div>
        </aside>




        
        <main class="main-section">
            
            <div class="main-nav">
                <!--OFFCANVAS mobile sidebar-->
                <button class="menu-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <svg class="menu-svg" xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px" fill="#FFFFFF">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                    </svg>
                </button>
               
                <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title" id="staticBackdropLabel">Welcome, Admin!</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <div>
                        <ul>
                            
                            <li><a href="pos.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M620-163 450-333l56-56 114 114 226-226 56 56-282 282Zm220-397h-80v-200h-80v120H280v-120h-80v560h240v80H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v200ZM480-760q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/></svg>Add Sales</a></li>

                            <li><a href="admin-products-management.php" ><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg>Manage Products</a></li>
    
                            <li><a href="statistics.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>Statistics</a></li>
    
                            <li><a href="admin-settings.php" class="sidebar-active-page"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>Admin Settings</a></li>
                        </ul>
                      </div>

                    </div> <!--Offcanvas body end-->

                    <div class="offcanvas-footer p-3 position-absolute bottom-0 w-100 ">
                        
                        <button class="log-out-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--tertiary-color)"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>Log out</button>
                    </div>

                </div>

                <h1>Admin Settings</h1>

            </div>

            <div class="main-body">
                
                <div class="admin-table-container">

                    <div class="btn-wrapper">
                        <button type="button" class="btn btn-primary admin-btn" data-bs-toggle="modal" data-bs-target="#add_admin">Add New Admin</button>

                            
                        <!-- Modal for add admin -->
                        <div class="modal fade" id="add_admin" tabindex="-1" aria-labelledby="add_admin_title" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="admin_title">Add Admin</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="add-admin-form">
                                            <div class="mb-3 form-group">
                                                <label for="admin_fname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="admin_fname" name="First Name">
                                                <span class="error-message"></span> 
                                            </div>

                                            <div class="mb-3 form-group">
                                                <label for="admin_lname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="admin_lname" name="Last Name">
                                                <span class="error-message"></span>  
                                            </div>

                                            <div class="mb-3 form-group">
                                                <label for="admin_new_email" class="form-label">Email</label>
                                                <input type="text" class="form-control" autocomplete="new-email" id="admin_email" name="Email"> 
                                                <span class="error-message"></span> 
                                            </div>

                                            <div class="mb-3 form-group">
                                                <label for="admin_new_pass" class="form-label">Enter Password</label>
                                                <input type="password" class="form-control " autocomplete="new-password" id="admin_pass" name="Password">
                                                <span class="error-message"></span>  
                                            </div>

                                            <div class="mb-3 form-group">
                                                <label for="re-enter" class="form-label">Re-enter Password</label>
                                                <input type="password" class="form-control " id="re-enter" name="Re-enter Password">
                                                <span class="error-message not-match-error"></span>
                                            </div>  
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="save_admin">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal for update admin -->
                        <div class="modal fade" id="update_ad_modal" tabindex="-1" aria-labelledby="update_ad_modal_title" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="admin_title">Update Admin</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="add-admin-form">
                                            <div class="mb-3 update-form-group">
                                                <label for="update_admin_fname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="update_admin_fname" name="First Name">
                                                <span class="error-message"></span> 
                                            </div>

                                            <div class="mb-3 update-form-group">
                                                <label for="update_admin_lname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="update_admin_lname" name="Last Name">
                                                <span class="error-message"></span>  
                                            </div>

                                            <div class="mb-3 update-form-group">
                                                <label for="update_admin_email" class="form-label">Email</label>
                                                <input type="text" class="form-control" autocomplete="new-email" id="update_admin_email" name="Email"> 
                                                <span class="error-message"></span> 
                                            </div>

                                            <div class="mb-3 update-form-group">
                                                <label for="admin_old_pass" class="form-label">Enter Old Password</label>
                                                <input type="password" class="form-control " autocomplete="new-password" id="admin_old_pass" name="Password">
                                                <span class="error-message"></span>  
                                            </div>

                                            <div class="mb-3 update-form-group">
                                                <label for="update_admin-new-password" class="form-label">Enter New Password</label>
                                                <input type="password" class="form-control " id="update_admin-new-password" name="Enter New Password">
                                                <span class="error-message not-match-error"></span>
                                            </div>  
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="update_admin">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    
                    <div class="table-wrap table-responsive">
                        <table class="table table-hover table-bordered rounded">
                            <thead class="table-info">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="admin-tbody">
                                
                                

                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>   
        </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script/admin-settings.js"></script>
    <script src="script/logout.js"></script>

</body>
</html>