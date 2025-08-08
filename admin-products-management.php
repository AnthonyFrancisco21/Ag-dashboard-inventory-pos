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
    <title>Products Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin-assets/dashboard.css">
    <link rel="stylesheet" href="admin-assets/admin-products.css">
</head>

<body data-admin-id="<?= $_SESSION['admin_id']; ?>">

    <div class="container-fluid d-flex m-0 p-0">

        <aside class="sidebar-section shadow">
            <div class="sidebar-wrapper">
                <header class="sidebar-header">
                    <img src="admin-assets/logo.png">
                    <h1>Welcome, Admin!</h1>
                </header>
    
                <main class="sidebar-main">
                    
                    <ul>
                        <li><a href="pos.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M620-163 450-333l56-56 114 114 226-226 56 56-282 282Zm220-397h-80v-200h-80v120H280v-120h-80v560h240v80H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v200ZM480-760q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/></svg>Add Sales</a></li>

                        <li><a href="admin-products-management.php" class="sidebar-active-page"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg>Manage Products</a></li>

                        <li><a href="statistics.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>Statistics</a></li>

                        <li><a href="admin-settings.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>Admin Settings</a></li>
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

                            <li><a href="admin-products-management.php" class="sidebar-active-page"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg>Manage Products</a></li>
    
                            <li><a href="statistics.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>Statistics</a></li>
    
                            <li><a href="admin-settings.php"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--blackText)"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>Admin Settings</a></li>
                        </ul>
                      </div>

                    </div> <!--Offcanvas body end-->

                    <div class="offcanvas-footer p-3 position-absolute bottom-0 w-100 ">
                        
                        <button class="log-out-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="var(--tertiary-color)"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>Log out</button>
                    </div>

                </div>

                <h1>Products Management</h1>

            </div>

            <div class="main-body">
                
                <div class="table-headers-buttons">

                    <div class="table-headers-buttons-wrap">

                        <div class="filter-categories-wrap">

                            <div class="filter">
                                <p>Filter:</p>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                                    <input type="radio" class="btn-check" name="btnradio" id="btnID" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" for="btnID">ID</label>
                                  
                                    <input type="radio" class="btn-check" name="btnradio" id="btnAZ" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnAZ">a-z</label>
                                  
                                    <input type="radio" class="btn-check" name="btnradio" id="btnZA" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnZA">z-a</label>

                                  </div>
                            </div>

                            <!-- drop down button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" id="cat_group_btn" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories 
                                </button>
                                <ul class="dropdown-menu dropdown-categories">
                                    <li><button class="dropdown-item active" data-category="">All Categories</button></li>
                                    <li><button class="dropdown-item" data-category="feeds">Feeds</button></li>
                                    <li><button class="dropdown-item" data-category="Supplements">Supplements</button></li>
                                    <li><button class="dropdown-item" data-category="Equipment">Farm Equipments</button></li>
                                    <li><button class="dropdown-item" data-category="Accessories">Pet Accessories</button></li>
                                    <li><button class="dropdown-item" data-category="others">Others</button></li>
                                </ul>
                            </div>


                        </div>
                        
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
                            Add Products
                        </button>
                        
                        <!-- Modal Add Product-->
                        <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addProductModalLabel">Add New Products</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form id="newProductForm">
                                                
                                                <div class="mb-3">
                                                  <label for="product-name-field" class="form-label">Product Name</label>
                                                  <input type="text" class="form-control" id="product-name-field" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="select-categories" class="form-label">Categories:</label>
                                                    <select class="form-select" id="select-categories" aria-label="Category select">
                                                        <option selected disabled>Choose...</option>
                                                        <option value="feeds">Feeds</option>
                                                        <option value="Supplements">Supplements</option>
                                                        <option value="Equipment">Farm Equipments</option>
                                                        <option value="Accessories">Pet Accessories</option>
                                                        <option value="others">others</option>
                                                      </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="imageUpload" class="form-label">Choose an image</label>
                                                    <input class="form-control" type="file" id="imageUpload" accept="image/*">

                                                    <div class="image-preview-container" id="imagePrev_container">
                                                        <img src="" alt="Image Preview" class="image_preview_img">
                                                        <span class="image_preview_text">Image Preview</span>
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="select-unit" class="form-label">Unit:</label>
                                                    <select class="form-select" id="select-unit" aria-label="Unit select">
                                                        <option selected disabled>Choose...</option>
                                                        <option value="kilo">Kilo</option>
                                                        <option value="sack">Sack</option>
                                                        <option value="bottle">Bottle</option>
                                                        <option value="pack">Pack</option>
                                                        <option value="piece">Piece</option>
                                                      </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="insert-price" class="price-label">Price:</label>
                                                    <input type="number" class="form-control" id="whole-price" min="0" required>
                                                    <span>.</span>
                                                    <input type="number" class="form-control" id="decimal-price" placeholder="00" min="0" max="99">
                                                    
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" id="close_btn_addProduct" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btn_addProduct" >Add</button>

                                    </div>
                                </div>
                            </div>
                        </div> <!--Modal add product end-->

                        <!-- Modal UPDATE PRODUCT-->
                        <div class="modal fade" id="modalUpdateProduct" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="updateProductModalLabel">Update Products</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form id="updateProductForm">
                                                
                                                <div class="mb-3">
                                                  <label for="product-name-update" class="form-label">Product Name</label>
                                                  <input type="text" class="form-control" id="product-name-update" >
                                                </div>

                                                <div class="mb-3">
                                                    <label for="select-categories" class="form-label">Categories:</label>
                                                    <select class="form-select" id="select-categories-update" aria-label="Category select">
                                                        <option selected disabled>Choose...</option>
                                                        <option value="feeds">Feeds</option>
                                                        <option value="Supplements">Supplements</option>
                                                        <option value="Equipment">Farm Equipments</option>
                                                        <option value="Accessories">Pet Accessories</option>
                                                        <option value="others">others</option>
                                                      </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="imageUpload-update" class="form-label">Choose an image</label>
                                                    <input class="form-control" type="file" id="imageUpload-update" accept="image/*">

                                                    <div class="update-image-preview-container" id="update-imagePrev_container">
                                                        <img src="" alt="Image Preview" class="update-image_preview_img">
                                                        <span class="update-image_preview_text">Image Preview</span>
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="select-unit-update" class="form-label">Unit:</label>
                                                    <select class="form-select" id="select-unit-update" aria-label="Unit select">
                                                        <option selected disabled>Choose...</option>
                                                        <option value="kilo">Kilo</option>
                                                        <option value="sack">Sack</option>
                                                        <option value="bottle">Bottle</option>
                                                        <option value="pack">Pack</option>
                                                        <option value="piece">Piece</option>
                                                      </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="insert-price-update" class="price-label">Price:</label>
                                                    <input type="number" class="form-control" id="whole-price-update" min="0" required>
                                                    <span>.</span>
                                                    <input type="number" class="form-control" id="decimal-price-update" placeholder="00" min="0" max="99">
                                                    
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" id="close_btn_updateProd" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btn_updateProd" >Update</button>

                                    </div>
                                </div>
                            </div>
                        </div> <!--Modal UPDATE end-->


                        <!-- Modal View PRODUCT-->
                        <div class="modal fade" id="modalViewProduct" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="updateProductModalLabel">Full Details.</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form id="updateProductForm">
                                                
                                                <div class="mb-3">
                                                  <label for="product-name-update" class="form-label">Product Name</label>
                                                  <input type="text" class="form-control" id="view-product-name" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="product-name-update" class="form-label">Category</label>
                                                    <input type="text" class="form-control" id="view-product-category" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="view-image-preview-container" id="view-imagePrev_container">
                                                        <img src="" alt="Image Preview" class="view-image_preview_img">
                                                        <span class="view-image_preview_text">Image Preview</span>
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="view-product-unit" class="form-label">Unit</label>
                                                    <input type="text" class="form-control" id="view-product-unit" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="view-product-price" class="form-label">Price</label>
                                                    <input type="text" class="form-control" id="view-product-price" readonly>
                                                    
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" id="close_btn_updateProd" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div> <!--Modal View Product end-->

                    </div> <!--table-headers-buttons-wrap end-->

                </div> <!--table-headers-buttons end-->

                <div class="searchbar">
                    <div class="input-group">
                        <input id="search_form" type="text" class="form-control" placeholder="Search Product" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        
                      </div>
                </div>

                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#archieve-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m480-240 160-160-56-56-64 64v-168h-80v168l-64-64-56 56 160 160ZM200-640v440h560v-440H200Zm0 520q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm264 300Z"/></svg>
                </button>

                <!-- Archive Modal -->
                <div class="modal fade" id="archieve-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Archieve</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div >
                            <div class=" table-wrap table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Categories</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="archive-tbody">
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                    </div>
                </div>
                </div>

                <div class=" table-wrap table-responsive">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Categories</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-data">
                            

                        </tbody>
                      </table>
                </div>         
            </div>
        </main>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script/admin-products.js"></script>
</body>
</html>