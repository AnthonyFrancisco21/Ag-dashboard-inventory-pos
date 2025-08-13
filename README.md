# AG-MAMACLAY-POULTRY-SYSTEM
A simple inventory, sale's statistics and point-of-sale (POS) system designed for managing products, sales, and categories.  
Built using **HTML, CSS, JavaScript (frontend)** and **PHP, MySQL (backend)**.

  **Features**
- Add sales and generate invoice
- Add, Update and Delete products
- Categorize products for easier browsing.
- Search and filter products.
- Sales tracking and basic POS interface.
- Responsive design/ Mobile friendly.
- Sales statistics and tracking.

**Tech Stack:** Frontend – HTML, CSS, Bootstrap, JavaScript | Backend – PHP, MySQL | Others – XAMPP, RESTful APIs, SweetAlert2, html2pdf


**Folder Structure**
```
├── .gitignore
├── README.md
├── admin-assets
│   ├── admin-products.css
│   ├── admin-settings.css
│   ├── dashboard.css
│   ├── login.css
│   ├── pos.css
│   ├── statistics.css
│   ├── logo.png
│   └── ... (SVG icons and other assets)
├── admin-login.php
├── admin-products-management.php
├── admin-settings.php
├── backend
│   ├── adminApi.php
│   ├── archiveProduct.php
│   ├── database.php
│   ├── getProduct.php
│   ├── getSale.php
│   ├── newAdmin.php
│   ├── newSale.php
│   ├── postProduct.php
│   ├── poultry_db.sql
│   ├── updateAdmin.php
│   ├── updateProduct.php
│   └── product_images/
│       └── mamaclay-logo.png
├── docs
│   └── screenshot
│       └── ... (System screenshots and other assets)
├── logout.php
├── pos.php
├── script
│   ├── admin-products.js
│   ├── admin-settings.js
│   ├── logout.js
│   ├── pos.js
│   └── statistics.js
└── statistics.php
```

**Installation**

1. **Start XAMPP**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL**

2. **Clone the repository:**
   - Make sure to clone it inside XAMPP's `htdocs` folder:
   ```bash
   git clone https://github.com/AnthonyFrancisco21/mamaclay-inventory-pos.git

3.**Import the database**
  - Open **phpMyAdmin** in XAMPP.  
  - Create a new database (e.g., `poultry_db`).  
  - Go to the **Import** tab.  
  - Download the SQL file: [poultry_db.sql](https://github.com/AnthonyFrancisco21/mamaclay-inventory-pos/raw/main/backend/poultry_db.sql)  
  - Import the downloaded file.

4. **Configure database connection**
  -Open backend/database.php
  -Update the variables with your XAMPP credentials:
    ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "poultry_db";
     ```

5. **Access the project**
   - On xampp control panel, start 'Apache' and 'Mysql'
   - Go to: `http://localhost/mamaclay-inventory-pos/`

6. **Login credentials**
   - Admin Email: `admin@gmail.com`  
   - Password: `admin`  
   > Use these to log in to the admin panel.
   
7. **System and Features Overview**

   - Add sales



   
