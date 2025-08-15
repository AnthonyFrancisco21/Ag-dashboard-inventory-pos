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
  
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/0ef2ca55-4808-4834-b147-2d58ef5d65c9" />
  
     >Click the "Eye" icon in a product's row to view its full details.
  
     ---

     <img  width="800" alt="image" src="https://github.com/user-attachments/assets/11b3e483-54d6-4410-bcd5-4c7d742b1006" />

     >The "Add Product" button in the top-left corner allows you to quickly add new items to the inventory list.
     
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/842a1584-a618-4c04-befa-ad1b29d77064" />
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/6c6a460d-ed24-4d22-99c3-d6afcb1f48bb" />

     >Clicking "Save" displays a success alert, confirming the product was added.
     
     ---

     <img width="800" alt="image" src="https://github.com/user-attachments/assets/1409c352-2974-4339-9618-747cf6fd78de" />
     
     >Click the "Update" icon on the product's row to update product on the list.
     
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/00c4ad2b-79c3-42fa-9f85-4dd0a7bb8001" />
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/51aabe76-d309-4ac9-8f2f-f7d1c087bcdb" />
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/bf3db29e-adc2-4259-b507-7fcf679c8913" />
     
     >A message saying "Update successful" will appear after updating.
     
     ---

     <img width="800" alt="image" src="https://github.com/user-attachments/assets/ee6d1fb6-013a-49cd-8742-d0d0662d2b90" />

     >Click the "Delete" icon in a product's row to delete the product.
     
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/648606c2-6990-4e70-a4ef-440875fcaa2e" />
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/3399b9f9-b0f9-4358-9173-a6e32ff6b38d" />

     >After deleting a product, a message saying "Product Deleted" will appear. The deleted product will then be saved in the Archive section for record keeping.
     
     ---

     <img width="800" alt="image" src="https://github.com/user-attachments/assets/dc796a26-972e-4acf-a217-ae3acded5e6c" />

     >Click the Archive button in the top-right corner to view all deleted products and recover them if needed
     
     <img width="800"  alt="image" src="https://github.com/user-attachments/assets/2e47dcab-6e9b-4cb4-a9b0-f6cd7abba4be" />
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/d5db170d-9abf-4681-b447-fbcf5ce705a9" />
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/03f2f781-5879-4474-88ee-dae621990b8b" />

     >After clicking the "Recover" icon on the product’s row, a message saying "Recovered Successfully" will appear, and the product will be restored to the main product list.
     
     ---

   - Statistics
  
     <img width="800" alt="image" src="https://github.com/user-attachments/assets/04dd10a3-549c-496c-9d7e-7bafee622d0a" />

     >The Statistics section provides a visual and numerical summary of the store’s daily performance, helping the admin quickly analyze sales trends and product movement. In general, statistics is the practice of collecting, analyzing, and presenting data in a meaningful way to support decision-making. Here, the dashboard uses real-time sales data to give actionable insights at a glance.

      1. Summary Cards (Top Section)
      
            - Today’s Sales – Total revenue generated from all completed transactions for the current day.
            
            - Today’s Customers – Number of unique customers served today.
            
            - Today’s Sold Items – Total quantity of products sold across all orders.
            
            - Total Products – Total active products available in the inventory.
      
      2. Sold Items by Category
      
            - A bar chart showing the distribution of sold items by category (e.g., Feeds, Supplements, Equipment, Accessories, Others).
            
            - This helps identify which product categories are most in demand for the day, guiding restocking decisions.
      
      3. Today’s Recent Sale Table
      
           - Displays a detailed list of recent transactions including Sale ID, Total Amount, Total Paid, and Change.
           
           - Useful for quickly reviewing transactions, verifying payments, and detecting anomalies in sales records.
        
      <img width="800" alt="image" src="https://github.com/user-attachments/assets/9af18c4b-5619-4d14-9829-f299ac9b2b43">

     4. Sales Graph (Monthly Overview)

           - This line graph visualizes total sales for each month of the year.
           
           - Providing a clear picture of seasonal or monthly trends.
             
      ---

   - Admin settings
    
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/ffa4406b-4436-4826-9155-5b971d69bbf8" />

       >Admin Settings allows you to view and manage information for all admin accounts.
       
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/452dff5d-8a1d-4a25-929c-2abc5e165c9e" />

       >The "Add New Admin" button at the top-left of the table lets you quickly add a new admin to the system.
       
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/605ec36c-2a05-47d0-97c1-7e2622494ec0" />

       >After clicking "Save", the message "Successfully added a new admin" will appear.
       
       ---

       <img width="800" alt="image" src="https://github.com/user-attachments/assets/3a1d0f10-a6c9-4fb1-b8e4-4df4b103fdc5" />

       >The "Update" icon in the rows allows you to update admin accounts. If no new password is provided, you can leave the password field empty.

       <img width="800" alt="image" src="https://github.com/user-attachments/assets/a37ae2de-d557-4026-a374-3b93a9a8040c" />
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/a4d14591-efa4-4c86-b8ec-fd8f2b07a27e" />

       >After updating the admin’s data, the message "Admin Updated Successfully" will appear.
       
       ---
       
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/85b613bc-405b-4750-84d1-36c9344f96cf" />

       >"Delete" icon in the rows lets you delete admin accounts, including your own.
      
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/257abc0b-06a9-403a-9de1-5573bac4cfd7" />
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/8b33da7f-4482-4d94-a93d-4bae83a0c720" />

       >After soft-deleting an admin account, the message 'Deleted Successfully' will be displayed."
       
       ---
  
   - Log out
  
       >The log out button is located at the bottom of the sidebar. Clicking it will log you out and redirect you to the login page.

       <img width="800" alt="image" src="https://github.com/user-attachments/assets/478127df-c5d9-4b7b-a183-1d7600900a28" />
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/681a9edf-f55c-42c2-8f44-9bac7a2d13db" />
       <img width="800" alt="image" src="https://github.com/user-attachments/assets/11ea6262-e868-476a-8255-fb4bc45f38a6" />

       ---

 ## Future Features

 Planned improvements and upcoming functionalities:
 
 - Multi-language support (English, Filipino, etc.)
 - Export statistics graph as PDF or Excel
 - Role-based access control
 - “Remember Me” feature
 - Forgot Password functionality
 - Gmail confirmation for adding new admin

**This project is a work in progress and will continue to improve over time.
Feedback and contributions are always welcome!**

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📬 Contact
- **Email:** [franciscoanthony82@gmail.com](mailto:franciscoanthony82@gmail.com)
- **GitHub:** [AnthonyFrancisco21](https://github.com/AnthonyFrancisco21)

 



       





           

       















     




     

  
     

     




    

   
