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
    <link rel="stylesheet" href="admin-assets/dashboard.css">
    <link rel="stylesheet" href="admin-assets/pos.css">
</head>

<body data-admin-id="<?= $_SESSION['admin_id']; ?>">

    <!-- Alerts -->
    <div id="liveAlertPlaceholder"></div>>

    <div class="container-fluid d-flex m-0 p-0 min-vh-100">

        <aside class="sidebar-section shadow">
            <div class="sidebar-wrapper">
                <header class="sidebar-header">
                    <img src="admin-assets/logo.png">
                    <h1>Welcome, Admin!</h1>
                </header>
    
                <main class="sidebar-main">
                    
                    <ul>
                        
                        <li><a href="pos.php" class="sidebar-active-page"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M620-163 450-333l56-56 114 114 226-226 56 56-282 282Zm220-397h-80v-200h-80v120H280v-120h-80v560h240v80H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v200ZM480-760q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/></svg>Add Sales</a></li>

                        <li><a href="admin-products-management.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg>Manage Products</a></li>

                        <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>Statistics</a></li>

                        <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>Messages & Mails</a></li>
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
                            
                            <li><a href="pos.php" class="sidebar-active-page"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M620-163 450-333l56-56 114 114 226-226 56 56-282 282Zm220-397h-80v-200h-80v120H280v-120h-80v560h240v80H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v200ZM480-760q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/></svg>Add Sales</a></li>

                            <li><a href="admin-products-management.php" ><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg>Manage Products</a></li>
    
                            <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>Statistics</a></li>
    
                            <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>Messages & Mails</a></li>
                        </ul>
                      </div>

                    </div> <!--Offcanvas body end-->

                    <div class="offcanvas-footer p-3 position-absolute bottom-0 w-100 ">
                        
                        <button class="log-out-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--tertiary-color)"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>Log out</button>
                    </div>

                </div>

                <h1>Point of Sale</h1>

            </div>

            <div class="main-body">
                <div class="item-wrap">

                    <section class="section-categories">
                    

                    <div class="section-categories-wrap">

                        <h2>Categories</h2>
                        <div class="categories-wrap-btn">
                            <button class="categories-btn" data-category="" >All Products</button>
                            <button class="categories-btn" data-category="feeds" >Feeds</button>
                            <button class="categories-btn" data-category="Supplements" >Supplements</button>
                            <button class="categories-btn" data-category="Equipment">Farm & Game Equipment</button>
                            <button class="categories-btn" data-category="Accessories" >Pet Nutrition & Accessories</button>
                            <button class="categories-btn" data-category="others" >Others</button>
                        </div>
                        
                    </div>

                    <div class="search-item-div">
                        <div class="search-item-div-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" height="27px" viewBox="0 -960 960 960" width="27px" fill="#000000"><path d="M765-144 526-383q-30 22-65.79 34.5-35.79 12.5-76.18 12.5Q284-336 214-406t-70-170q0-100 70-170t170-70q100 0 170 70t70 170.03q0 40.39-12.5 76.18Q599-464 577-434l239 239-51 51ZM384-408q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Z"/></svg>
                            <input type="text" id="search-item" placeholder="Search products...">
                            <button>Search</button>
                        </div>
                    </div>
                    
                    </section>

                    <section class="products-item-section" id="product-container">
                        <h1 id="categories-title">All Products</h1>
                        

                        <!--  ITEM CARD -->
                        <div class="item-card-wrap">
    
                        </div>
                       
                        <!-- Modal for entering a quantity -->
                        <div class="modal fade" id="added_quantity" tabindex="-1" aria-labelledby="quantity_modal_title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="quantity_modal_title">Product's name</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="quantity_form" class="form-label">Quantity:</label>
                                    <div class="d-flex gap-2 align-items-center">
                                        <input type="text" class="form-control w-60" id="quantity_form" style="max-width: 60%; text-align:center;" placeholder="00.0">
                                        <p id="show_unit" class="mb-0 w-40" style="max-width: 40%;"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="add_item">Add to receipt</button>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Modal for Enter Cash Amount -->
                        <div class="modal fade" id="enter_amount_modal" tabindex="-1" aria-labelledby="enter_amount" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="enter_amount">Enter Cash amount</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <label for="enter_cash_form" class="form-label mb-0 fs-3">₱</label>
                                        <input type="text" class="form-control w-50 text-center" id="enter_cash_form" placeholder="00.0">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div id="warning-for-cash" class="alert alert-danger mt-2">❌ Not Enough Cash</div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save_item_btn">
                                    <span class="spinner-area" style="display: none;">
                                        <span class="spinner-border spinner-border-sm me-1" aria-hidden="true"></span>
                                        <span role="status">Loading...</span>
                                    </span>
                                    <span class="label-area">Save</span>
                                    
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>


                        <!-- Modal for change and receipt -->
                        <div class="modal fade" id="modal_receipt" tabindex="-1" aria-labelledby="change_receipt" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="change_receipt">Change & Receipt</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <div class="d-flex align-items-center justify-content-center flex-column gap-4">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <label class="form-label mb-0 fs-3">Total change:</label>
                                            <p id="show_change" class="m-0 p-0 fs-3"></p>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="download_receipt_btn">Download Receipt</button>
                                    </div>
                                </div>

                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    
                                </div>
                            </div>
                        </div>
                        </div>

                    </section>

                </div>

                <div class="receipt-wrap">
                    <div class="receipt">
                        <div class="mb-3">
                            <label for="textarea_receipt" class="form-label">Receipt</label>
                            <textarea class="form-control" id="textarea_receipt" rows="15" style="font-size: 13px; pointer-events: none;"></textarea>
                        </div>
                    </div>

                    <div class="total">
                        <div class="mb-3">
                            <label for="textarea_total" class="form-label">TOTAL</label>
                            <input class="form-control" id="textarea_total"  style="text-align: center; pointer-events: none;" placeholder="₱0.00" readonly>
                        </div>
                    </div>

                    <div class="receipt-btn">
                        <button type="button" class="btn btn-danger" id="remove_btn">Remove</button>
                        <button type="button" class="btn btn-primary" id="proceed_btn">Proceed</button>
                    </div>

                </div>
                

            </div>

                
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script src="pos.js"></script>

</body>
</html>