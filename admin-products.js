document.addEventListener('DOMContentLoaded', function (){
    
    loadData();
    loadscript();
    
    const modal = document.getElementById('modalAddProduct');
    if (modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('newProductForm').reset();

            const preview_image = document.querySelector(".image_preview_img");
            const preview_text = document.querySelector(".image_preview_text");

            if (preview_image && preview_text) {
                preview_image.src = "";
                preview_image.style.display = "none";
                preview_text.style.display = "block";
            }

        });
    }

    const modalUpdate = document.getElementById('modalUpdateProduct');
    if (modalUpdate) {
        modalUpdate.addEventListener('hidden.bs.modal', function () {
            document.getElementById('updateProductForm').reset();

            const preview_image = document.querySelector(".update-image_preview_img");
            const preview_text = document.querySelector(".update-image_preview_text");

            if (preview_image && preview_text) {
                preview_image.src = "";
                preview_image.style.display = "none";
                preview_text.style.display = "block";
            }

        });
    }
    
})

const adminID = document.body.dataset.adminId;


async function loadData(){
    tableData();
    const data = await getProduct();
    tableData(data);
    //functionname(data) to pass the data as argument
}

function loadscript(){
    categories_dropdown();
    addProduct();
    imagePreview();
    deleteProduct();
}

function resetModal(){
    const form = document.getElementById('newProductForm');
    form.reset();

}

//Get data by category, if none/null get all
async function getProduct(category = ''){

    try{
        const fetchdata = await fetch(`http://localhost/AG_MAMACLAY_DASHBOARD/backend/getProduct.php?category=${category}`);
        const jsondata = await fetchdata.json();
        return jsondata['data'];
    }
    catch (error){
        console.error(error);
        return [];
    }

}

async function categories_dropdown() {

    let categories_btn = document.querySelectorAll(".dropdown-item");

    categories_btn.forEach(item => {
        item.addEventListener('click', async function () {
            let selected_categories = this.dataset.category;
            categories_btn.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            const data = await getProduct(selected_categories);
            tableData(data);
            
        });
    });
}


function addProduct(){
    const btn_addProduct = document.getElementById("btn_addProduct");

    const whole_price = document.getElementById("whole-price");
    const decimal_price = document.getElementById("decimal-price");

    whole_price.addEventListener('input', () => {
        let value = whole_price.value;
        value = value.replace(/\D/g, '');
        whole_price.value = value;

    })

    decimal_price.addEventListener('input', () => {
        let value = decimal_price.value;

        value = value.replace(/\D/g, '').slice(0, 2);
        decimal_price.value = value;
    })
    

    btn_addProduct.addEventListener('click', async function (event) {

        const product_name = document.getElementById("product-name-field").value;
        const selected_category = document.getElementById("select-categories").value;
        const image_file = document.getElementById("imageUpload").files[0];
        const selected_unit = document.getElementById("select-unit").value;
        const closemodal = document.getElementById("close_btn_addProduct");
        
        /* const = Admin id from session - missing for now, and add manually in php for now */

        const whole = parseInt(whole_price.value);
        let decimal = decimal_price.value;

        if (decimal === ''){
            decimal = '00';
        }else if(decimal.length === 1){
            decimal = '0' + decimal;
        }

        const finalPrice = `${whole}.${decimal}`;

        const formData = new FormData();
        formData.append("product_name", product_name);
        formData.append("selected_category", selected_category);
        formData.append("image_file", image_file);
        formData.append("selected_unit", selected_unit);
        formData.append("final_price", finalPrice);
        formData.append("admin_id", adminID);

        try{
            const res = await fetch("http://localhost/AG_MAMACLAY_DASHBOARD/backend/postProduct.php", {
            method: "POST",
            body: formData
            });

            const result = await res.json();

            if(result.success){
                alert("Product added!");
                loadData();
                resetModal();
                //Hide the modal--
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalAddProduct'));
                if (modal) modal.hide();
                return;
            }else{
                alert("Error please try again!");
                console.log("Error message: ", result.message);
            }

        }catch(err){
            console.error("Upload failed, error in try", err);
            
        }
        

    })

} //add product edd


function deleteProduct(){

    const delete_btn = document.querySelectorAll(".delete-btn");

    delete_btn.forEach((delete_prod) => {
        delete_prod.addEventListener('click', async function(){

            const id = this.getAttribute('data-id');
            
            if(confirm("Are you sure you want to delete this product?")){

                try{    
                const response = await fetch("http://localhost/AG_MAMACLAY_DASHBOARD/backend/deleteProduct.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({id})
                    });
                
                    const result = await response.json();
                    console.log(result);

                    if(result.success){
                        alert("Product deleted");
                        loadData();
                        return;
                    }else{
                        alert("error delete")
                    }


                } catch(err){
                    console.log(`Error ${err}`);
                }

            }
            
        })
    })

}

//update products
let current_product_id = null;
let product_image_old = null;
let whole_price_form = document.getElementById("whole-price-update");
let decimal_price_form = document.getElementById("decimal-price-update");
function updateProduct(){

    const update_btn = document.querySelectorAll(".update-btn");
    whole_price_form.addEventListener('input', () => {
        let value = whole_price_form.value;
        value = value.replace(/\D/g, '');
        whole_price_form.value = value;

    })

    decimal_price_form.addEventListener('input', () => {
        let value = decimal_price_form.value;

        value = value.replace(/\D/g, '').slice(0, 2);
        decimal_price_form.value = value;
    })

    update_btn.forEach((update_prod) => {
        update_prod.addEventListener('click', function(){

            current_product_id = update_prod.dataset.product_id;
            const product_name = update_prod.dataset.product_name;
            const product_categories = update_prod.dataset.product_categories;
            product_image_old = update_prod.dataset.image;
            const product_price = update_prod.dataset.price;
            const product_unit = update_prod.dataset.unit;
            const [wholePrice, decimalPrice] = product_price.split(".");

            document.getElementById("product-name-update").value = product_name;
            document.getElementById("select-categories-update").value = product_categories;
            whole_price_form.value = wholePrice;
            decimal_price_form.value = decimalPrice;
            document.getElementById("select-unit-update").value = product_unit; 

            const image_cont_update = document.getElementById("update-imagePrev_container"); 
            const preview_image_update = image_cont_update.querySelector(".update-image_preview_img");
            const preview_image_text_update = image_cont_update.querySelector(".update-image_preview_text");

            const image_update_form = document.getElementById("imageUpload-update");
            preview_image_update.style.display = "block";
            preview_image_text_update.style.display = "none";
            preview_image_update.setAttribute('src', `backend/${product_image_old}`);

            image_update_form.addEventListener('change', function() {

                const image_file = this.files[0];

                if(image_file){
                    const reader = new FileReader();

                    reader.addEventListener('load', function() {
                        preview_image_update.setAttribute("src", this.result);
                    });

                    reader.readAsDataURL(image_file);
                } else{
                    preview_image_text_update.style.display = "null";
                    preview_image_update.display = "null";
                    preview_image_update.setAttribute('src', `backend/${product_image_old}`);
                }

                
            })
        })
    })

}
//outside of the update function because 
//eventlistener repeats causing duplications when updating
document.getElementById("btn_updateProd").addEventListener('click', async function(){

    const new_product_name = document.getElementById("product-name-update").value;
    const new_product_categories = document.getElementById("select-categories-update").value;
    const image_update_form = document.getElementById("imageUpload-update").files[0];
    
    const new_whole_price = whole_price_form.value;
    let new_decimal_price = decimal_price_form.value;
    const new_unit = document.getElementById("select-unit-update").value;

    if(new_decimal_price === ""){
        new_decimal_price = "00"
    } else if(new_decimal_price.length === 1){
        new_decimal_price = "0" + new_decimal_price;
    }

    const finalPrice = `${new_whole_price}.${new_decimal_price}`;

    const formData = new FormData();
    formData.append("product_id", current_product_id);
    formData.append("product_name", new_product_name);
    formData.append("selected_category", new_product_categories);
    formData.append("old_image", product_image_old);
    formData.append("new_image",  image_update_form);
    formData.append("selected_unit", new_unit);
    formData.append("price", finalPrice);
    formData.append("admin_id", adminID);
    
    if(confirm("Are you sure you want to update this product?")){

        try{
        const response = await fetch("http://localhost/AG_MAMACLAY_DASHBOARD/backend/updateProduct.php", {
        method: "POST",
        body: formData
        });

        /* const result = await response.json();
        console.log(result); */
        const text = await response.text();
        console.log("RAW RESPONSE:", text);
        const result = JSON.parse(text);

        if(result.success){
            alert("Product updated!");
            loadData();
            resetModal();
            //Hide the modal--
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalUpdateProduct'));
            if (modal) modal.hide()
            return;
        }else{
            alert("Error please try again!");
            console.log("Error message: ", result.message);
        }
        
        }catch(err){
            console.log(`Something went wrong, please try again! ${err}`);
        }

    }

})//end updatebtn


function setupTableFilters() {
    const btnID = document.getElementById("btnID");
    const btnAZ = document.getElementById("btnAZ");
    const btnZA = document.getElementById("btnZA");

    const tbody = document.querySelector("table tbody");

    function sortTable(compareFn) {
        const rows = Array.from(tbody.querySelectorAll("tr"));
        rows.sort(compareFn);
        rows.forEach(row => tbody.appendChild(row)); 
    }

    btnID.addEventListener("change", function () {
        sortTable((a, b) => {
            const idA = parseInt(a.children[0].textContent);
            const idB = parseInt(b.children[0].textContent);
            return idA - idB; 
        });
    });

    btnAZ.addEventListener("change", function () {
        sortTable((a, b) => {
            const nameA = a.children[1].textContent.toLowerCase();
            const nameB = b.children[1].textContent.toLowerCase();
            return nameA.localeCompare(nameB); 
        });
    });

    btnZA.addEventListener("change", function () {
        sortTable((a, b) => {
            const nameA = a.children[1].textContent.toLowerCase();
            const nameB = b.children[1].textContent.toLowerCase();
            return nameB.localeCompare(nameA); 
        });
    });

   
}




function viewProduct(){

    const view_product = document.querySelectorAll(".view-btn");

    view_product.forEach((view) => {

        view.addEventListener('click', function() {

            const view_current_product_id = view.dataset.product_id;
            const product_name = view.dataset.product_name;
            const product_categories = view.dataset.product_categories;
            const product_image_old = view.dataset.image;
            const product_price = view.dataset.price;
            const product_unit = view.dataset.unit;

            document.getElementById("view-product-name").value = product_name;
            document.getElementById("view-product-category").value = product_categories;
            document.getElementById("view-product-unit").value = product_unit;
            document.getElementById("view-product-price").value = product_price;

            const image_container = document.getElementById("view-imagePrev_container");
            const preview_image = image_container.querySelector(".view-image_preview_img");
            const preview_image_text = image_container.querySelector(".view-image_preview_text");

            preview_image.style.display = "block";
            preview_image_text.style.display = "none";
            preview_image.setAttribute('src', `backend/${product_image_old}`);

        })
        

    })


}


//For add
function imagePreview(){

    const image_form = document.getElementById("imageUpload");
    const image_container = document.getElementById("imagePrev_container");
    const preview_image = image_container.querySelector(".image_preview_img");
    const preview_image_text = image_container.querySelector(".image_preview_text");

    image_form.addEventListener('change', function() {

        const file = this.files[0];

        if(file){
            const reader = new FileReader();
            preview_image_text.style.display = "none";
            preview_image.style.display = "block";

            reader.addEventListener('load', function() {
                preview_image.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);
        } else{
            preview_image_text.style.display = "null";
            preview_image.style.display = "null";
            preview_image.setAttribute("src", "")
        }

    })
}


function searchFunction(){

    const search_form = document.getElementById("search_form");

    search_form.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll("table tbody tr");

        let matchCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(keyword)) {
                row.style.display = "";
                matchCount++;
            } else {
                row.style.display = "none";
            }
        });

        
        const tbody = document.querySelector("table tbody");
        const noDataRow = document.getElementById("no-data-row");

        if (matchCount === 0) {
            if (!noDataRow) {
                const tr = document.createElement("tr");
                tr.id = "no-data-row";
                tr.innerHTML = `<td colspan="6" class="text-center text-muted">No data found</td>`;
                tbody.appendChild(tr);
            }
        } else {
            if (noDataRow) {
                noDataRow.remove();
            }
        }

    });

}

async function tableData(data){
    const table = document.querySelector('table tbody');

    if (!data) {
        table.innerHTML = `<tr><td colspan="6" class="text-center">Loading...</td></tr>`;
        return;
    }

    let tableHTML = "";
    if(data.length === 0){
        table.innerHTML = "<tr><td class='no-data' colspan='6'> No data </td></tr>";
    }
    else{
        data.forEach((product) => {
            tableHTML += `<tr>
                <td>${product.product_id}</td>
                
                <td>${product.product_name}</td>
                <td>${product.categories}</td>
                <td>${product.price}</td>
                <td>
                    
                    <button class="view-btn" data-bs-toggle="modal" data-bs-target="#modalViewProduct" 
                    data-product_id="${product.product_id}"
                    data-product_name="${product.product_name}"
                    data-product_categories="${product.categories}"
                    data-image="${product.image_path}"
                    data-unit="${product.unit}"
                    data-price="${product.price}"
                    > <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#7CA7D8"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                    </button>

                    <button class="update-btn" data-bs-toggle="modal" data-bs-target="#modalUpdateProduct"
                    data-product_id="${product.product_id}"
                    data-product_name="${product.product_name}"
                    data-product_categories="${product.categories}"
                    data-image="${product.image_path}"
                    data-price="${product.price}"
                    data-unit="${product.unit}"
                    > <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#78A75A"><path d="M560-80v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-300L683-80H560Zm300-263-37-37 37 37ZM620-140h38l121-122-18-19-19-18-122 121v38ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v120h-80v-80H520v-200H240v640h240v80H240Zm280-400Zm241 199-19-18 37 37-18-19Z"/></svg> </button>

                    <button class="delete-btn" data-id="${product.product_id}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA3323"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg> </button>
                </td>
                
            </tr>`;
        });

        table.innerHTML = tableHTML;
        setupTableFilters();
        viewProduct();
        updateProduct();
        deleteProduct();
        searchFunction();
    }
}




