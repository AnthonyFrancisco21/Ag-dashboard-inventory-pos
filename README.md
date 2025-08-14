AG-MAMACLAY-POULTRY-SYSTEM
==========================

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
│   └── screenshots
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
   - Point of Sale
     
     <img src="https://github.com/user-attachments/assets/416bd708-628b-457c-97f8-c48298d63348" alt="Point of Sale Overview" width="800">
     
     >The point of sale lets you quickly search and filter products to add to a customer’s purchase.
     
     ---
     
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/e05343f4-fc52-4d0b-a26f-f4e1c2fdcfca" />

     > In the second image, we clicked on a product card (representing the customer's purchase), entered the quantity, and then clicked **Add to Receipt**.

     ---

     <img width="800" alt="image" src="https://github.com/user-attachments/assets/5ea4ac68-34d4-4b59-9fb0-1a6a43bb829e" />

     >After adding the customer’s purchase, it will appear in the receipt section on the left side, where you can view all purchased items along with the total amount.
     
     ---

     <img width="800" alt="image" alt="image" src="https://github.com/user-attachments/assets/a023e2d4-b9de-48ae-a92a-c05b51906a98" />

     >Once the customer's purchase is finalized, click the "Proceed" button to move to the payment stage. Here, you can enter the amount of cash provided by the customer.

      ---

     <img width="800" alt="image" src="https://github.com/user-attachments/assets/bf78c01a-9d3a-4e83-8461-171b82f2412e" />

     <img width="800" alt="image" src="https://github.com/user-attachments/assets/60bb8832-f160-4858-a897-e7202d741509" />

     >After saving the customer's payment, the invoice will be automatically generated along with the total change, converted into a PDF, and ready for printing.
     
     ---

   - Product Management
  
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/7e4eb6dd-c8aa-4f58-b69d-abbb26fa3a09" />

     >The Product Management module allows you to quickly search, filter, and manage all products available for purchase.
     
     ---

     

  
     

     




    

   
