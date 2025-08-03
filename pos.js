document.addEventListener('DOMContentLoaded', function (){

loadscript();
loadData();

})

function loadscript() {
    categoryFunction();
    quantityModal();
    enterCashModal();
}

async function loadData(){

    const data = await getProduct();
    showProducts(data);
}

function showBootstrapAlert(message, type = 'success') {
  const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
  
  const alert = document.createElement('div');
  alert.className = `alert alert-${type} alert-dismissible fade show`;
  alert.setAttribute('role', 'alert');
  alert.innerHTML = `
    <span>${message}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;

  alertPlaceholder.appendChild(alert);

  // Optional auto-dismiss
  setTimeout(() => {
    alert.classList.remove('show');
    alert.classList.add('fade');
    alert.addEventListener('transitionend', () => alert.remove());
  }, 4000);
}

async function categoryFunction(){

    const category_btn = document.querySelectorAll(".categories-btn");

    category_btn.forEach((btn) => {
        btn.addEventListener('click', async function () {
            let selected_category = this.dataset.category;
            const data = await getProduct(selected_category);
            showProducts(data);
        });
    });

}


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

}//getProduct() end



const adminID = document.body.dataset.adminId;
let = selectedItem = [];
let currentProduct = null;
const textarea_receipt = document.getElementById("textarea_receipt");
const textarea_total = document.getElementById("textarea_total");
let total = 0;

function quantityModal(){

    const quantity_form = document.getElementById("quantity_form");

    quantity_form.addEventListener('input', () => {
    let value = quantity_form.value;

    // Allow only digits and one dot
    value = value.replace(/[^0-9.]/g, '');

    // Prevent multiple dots
    const parts = value.split('.');
    if (parts.length > 2) {
        value = parts[0] + '.' + parts[1]; // Keep only the first dot
    }

    // Limit to 2 decimal places
    if (parts.length === 2) {
        parts[1] = parts[1].slice(0, 2); // Only 2 digits after decimal
        value = parts[0] + '.' + parts[1];
    }

    quantity_form.value = value;
    });

    // On blur: format to 2 decimal places
    quantity_form.addEventListener('blur', () => {
        const value = quantity_form.value;
        if (!isNaN(value) && value !== '') {
            quantity_form.value = parseFloat(value).toFixed(2);
        }
    });


    document.getElementById("add_item").addEventListener('click', function(){
        const quantity_value = parseFloat(document.getElementById("quantity_form").value);

        if(isNaN(quantity_value)){
            return;
        }

        const total_price_per_item = parseFloat((currentProduct.price * quantity_value).toFixed(2));

        const saleItem = {
            sale_product_id: currentProduct.product_id,
            product_name_invoice: currentProduct.product_name, //For invoice showing only
            unit_invoice: currentProduct.unit, //For invoice showing only
            product_price: currentProduct.price,
            quantity: quantity_value,
            total_price_per_item: total_price_per_item

        };

        selectedItem.push(saleItem);

        textarea_receipt.value += `• ${currentProduct.product_name} - ${quantity_value}x - ₱${total_price_per_item.toFixed(2)}\n`;

        //compute the total of item that has been selected
        total = selectedItem.reduce((sum, item) => {
            return sum + parseFloat(item.total_price_per_item);
        }, 0);

        textarea_total.value = `₱${total.toFixed(2)}`;

        const modalEl = document.getElementById('added_quantity');
        const modal = bootstrap.Modal.getInstance(modalEl);
        document.getElementById("quantity_form").value = "";
        if (modal) modal.hide();

    });

}// quantityModal() end

//proceed btn
document.getElementById('proceed_btn').addEventListener('click', function(){
    if(selectedItem.length === 0){
        return;
    }
    const enterAmountModal = new bootstrap.Modal(document.getElementById('enter_amount_modal'));
    enterAmountModal.show();
});


function enterCashModal(){

    const cash_form = document.getElementById("enter_cash_form");

    cash_form.addEventListener('input', () => {

        let value = cash_form.value;
        value = value.replace(/\D/g, '');
        cash_form.value = value;
    });

    document.getElementById("save_item_btn").addEventListener('click', async function() {

        const btn = document.getElementById('save_item_btn');
        const spinner = btn.querySelector('.spinner-area');
        const label = btn.querySelector('.label-area');

        const amountPaid = document.getElementById("enter_cash_form").value;
        const warning = document.getElementById("warning-for-cash");
        
        let totalChange = amountPaid - total;
        
        if(totalChange < 0){
            warning.style.display = "block";
            return;
        }else{
            warning.style.display = "none";
        }

        // Show loading state
        spinner.style.display = 'inline-flex';
        label.style.display = 'none';
        btn.disabled = true;

        const wholeSale = {
            selectedItem,
            amountPaid,
            total,
            totalChange,
            adminID
        };

        try{
            const response = await fetch("http://localhost/AG_MAMACLAY_DASHBOARD/backend/newSale.php", {
                method: "POST",
                headers: {
                "Content-Type": "application/json"
                },
                body: JSON.stringify(wholeSale)
            }); 

            const result = await response.json();

            setTimeout( () => {
                
                if(result.success){
                showInvoice(amountPaid, totalChange);

                const modalEl = document.getElementById('enter_amount_modal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                document.getElementById("enter_cash_form").value = "";
                if (modal) modal.hide();

                const modalReceipt = new bootstrap.Modal(document.getElementById('modal_receipt'));
                modalReceipt.show();

                showBootstrapAlert(result.message, 'success');
                //For spinner
                spinner.style.display = 'none';
                label.style.display = 'inline';
                btn.disabled = false;

                return;
                }else{
                    showBootstrapAlert('❌ An error occurred. Please try again', 'danger');
                    //For spinner
                    spinner.style.display = 'none';
                    label.style.display = 'inline';
                    btn.disabled = false;
                }

            }, 1000)

            
        }
        catch(error){
            console.log(`Error in try catch ${error}`);
        } 
    })

}//enterCashModal() end


//remove an item from the receipt and list of item sales
document.getElementById('remove_btn').addEventListener('click', function () {
    selectedItem.pop();

    textarea_receipt.value = selectedItem.map(item =>
    `• ${item.product_name_invoice} - ${item.quantity}x - ₱${item.total_price_per_item.toFixed(2)}`
    ).join('\n') + '\n';

    total = selectedItem.reduce((sum, item) => {
    return sum + parseFloat(item.total_price_per_item);
    }, 0);

    textarea_total.value = `₱${total.toFixed(2)}`;

});

function showInvoice(amountPaid, totalChange){

    const invoiceBodyContainer = document.getElementById("invoice-body-container");
    const invoiceTotal = document.getElementById("invoice-total");
    const invoiceCash = document.getElementById("invoice-cash");
    const invoiceChange = document.getElementById("invoice-change");

    let invoiceRenderer = "";

    selectedItem.forEach((item) => {
        invoiceRenderer+= `
            <div class="invoice-body">
                <div class="invoice-product">
                    <p class="product-name-invoice">${item.product_name_invoice}</p>
                    <div class="unit-and-quantity-wrap">
                        <p class="quantity-invoice">${item.quantity}</p>
                        <p class="unit-invoice">${item.unit_invoice}</p>
                    </div>
                    
                </div>
                <p class="invoice-price-per-item">${item.total_price_per_item}</p>
            </div>
        
        `
    })

    invoiceTotal.textContent = total;
    invoiceCash.textContent = amountPaid;
    invoiceChange.textContent = totalChange;
    

    invoiceBodyContainer.innerHTML = invoiceRenderer;

    setTimeout( () => {
        downloadInvoice();
    }, 1000)

    

}

function downloadInvoice() {
    const invoiceFrame = document.getElementById("invoice-print");
    const invoiceHeightPx = invoiceFrame.offsetHeight;
    const invoiceHeightMm = invoiceHeightPx / 3.7795;

    const opt = {
      margin:       0,
      filename:     'receipt.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF: {
        unit: 'mm',
        format: [80, invoiceHeightMm], // width, height in mm (80mm wide receipt)
        orientation: 'portrait'
      }
    };

    
    html2pdf().set(opt).from(invoiceFrame).save();

    selectedItem = [];
    textarea_receipt.value = "";
    textarea_total.value = "";
}




async function showProducts(data) {
    const container = document.querySelector(".item-card-wrap");
    container.innerHTML = ""; // Clear previous products
    const show_unit = document.getElementById("show_unit");
    const show_title = document.getElementById("quantity_modal_title");

    //show products in a card
    data.forEach((product) => {
        const itemDiv = document.createElement("div");
        itemDiv.classList.add("item");

        itemDiv.innerHTML = `
            <img src=" backend/${product.image_path}" class="item-img" alt="${product.product_name}">
            <p class="item_description">${product.product_name}</p>
            <p class="item_description">₱${product.price}</p>
        `;

        container.appendChild(itemDiv);

        itemDiv.addEventListener('click', function(){
            //put the clicked product to the currentProduct to be use globally
            currentProduct = product;
            
            const quantity_form = new bootstrap.Modal(document.getElementById('added_quantity'));
            quantity_form.show();

            show_title.textContent = currentProduct.product_name;
            show_unit.textContent = currentProduct.unit;
        })

    });//for each end

}
