document.addEventListener('DOMContentLoaded', function() {

    loadData();
})


async function loadData(){
    const product_data = await getProduct();
    const { sales, sales_per_product } = await getSalesAndSalesByProduct();

    productCard(product_data);
    saleTodayCard(sales, sales_per_product);
    soldByCategoryGraph(product_data, sales_per_product)
    salesGraph(sales);
    invoiceTable(sales);
}


async function getProduct(category = ''){

   try{
        const fetchdata = await fetch(`./backend/getProduct.php?category=${category}`);
        const jsondata = await fetchdata.json();
        return jsondata['data'];
       
    }
    catch (error){
        console.error(error);
        return [];
    }
}

async function getSalesAndSalesByProduct(){
    try{
        const salesData = await fetch(`./backend/getSale.php`)
        const jsonData = await salesData.json();

        return {
            sales: jsonData.Sales,
            sales_per_product: jsonData.Sales_per_product
        };

    }catch (error){
        console.error(error)
        return[];
    }
}

function productCard(product_data){
    const showProductCount = document.getElementById("total-product-count");

    showProductCount.textContent = product_data.length;

}

function saleTodayCard(sales, sales_per_product){

    const showTodaySale = document.getElementById("todays-sale");
    const showTodayCustomerCount = document.getElementById("todays-customers");
    const showTodaySaleCount = document.getElementById("todays-sold-count");

    const today = new Date();
    const dateNow = today.getFullYear() + '-' +
    String(today.getMonth() + 1).padStart(2, '0') + '-' +
    String(today.getDate()).padStart(2, '0');

    let todaySales = [];
    let todaysTotalSale = null; 

    sales.forEach(element => {

         if(element.date_sold === dateNow){
            
            todaySales.push(element)
        } 

    });
    
    todaysTotalSale = todaySales.reduce((sum, item) => {
        return sum + parseFloat(item.total_price);
    }, 0); 

    //Filter the today sale id
    const todaySaleId = sales.filter(item => item.date_sold === dateNow).map(item => item.sale_id);
    //Compare the today sale id on sold per item to know how many item does customer's bought
    const sold_per_item = sales_per_product.filter(item => todaySaleId.includes(item.sale_id))

    showTodaySale.textContent = todaysTotalSale;
    showTodayCustomerCount.textContent = todaySales.length;
    showTodaySaleCount.textContent = sold_per_item.length;


}


let categoryChartInstance = null;
function soldByCategoryGraph(itemData, productSoldData) {
    
    const feedsQuantity = getTotalQuantity(itemData, productSoldData, 'feeds');
    const supplementsQuantity = getTotalQuantity(itemData, productSoldData, 'Supplements');
    const equipmentsQuantity = getTotalQuantity(itemData, productSoldData, 'Equipment');
    const accessoriesQuantity = getTotalQuantity(itemData, productSoldData, 'Accessories');
    const othersQuantity = getTotalQuantity(itemData, productSoldData, 'others');

    if (categoryChartInstance) {
        categoryChartInstance.destroy();
    }


    const sbcg = document.getElementById('sold-by-category-graph');

    categoryChartInstance = new Chart(sbcg, {
        type: 'bar',
        data: {
        labels: ['Feeds', 'Supplements', 'Equipments', 'Accessories', 'Others'],
        datasets: [{
            label: '# of Qauntity',
            data: [feedsQuantity, supplementsQuantity, equipmentsQuantity, accessoriesQuantity, othersQuantity],
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

}

let salesChartInstance = null; 
function salesGraph(sales){

    const yearNow = new Date().getFullYear();
    // --1. Call this function to compute the sale on every month
    const monthlyTotal = getMonthlySales(sales, yearNow)
    
    const salesGraph = document.getElementById("sales_graph");

     if (salesChartInstance) {
        salesChartInstance.destroy(); // Destroy previous chart
    }

    const data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
        label: 'Sales',
        data: monthlyTotal,
        fill: true,
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        tension: 0.4
    }]
    };

    const config = {
    type: 'line',
    data: data,
    options: {
        scales: {
        y: {
            beginAtZero: false
        }
        }
    }
    };

    salesChartInstance = new Chart(salesGraph, config);
}
  


//--2. Pass all the sale data and the year now
function getMonthlySales(sales, year){

    const monthlyTotalSale = [];


    //Loop to create an array for month example 2020-07 - 2020-08 ect..
    for(i = 1; i <= 12; i++){
        const month = String(i).padStart(2, '0');
        const monthKey = `${year}-${month}`

        //--3 Call and pass the sales and monthKey to filter only the data with the match of monthkey(2020-07)
        const monthSale = getSoldByMonth(sales, monthKey);


        //--5. monthSale now contain the date_sold to the monthKey and compute all the total_price
        const total = monthSale.reduce((sum, item) => {
            return sum + parseFloat(item.total_price);
        }, 0); 

        monthlyTotalSale.push(total);
    }
    //Push and return the total sale to use on graph
    return monthlyTotalSale;


}


function getSoldByMonth(sales, monthKey){
    


    if (!Array.isArray(sales)) {
        console.error("sales is not an array:", sales);
        return [];
    }
    
    //--4. Compare the date_sold to monthKey and pass it again to const monthSale
    const monthAndYear = sales.filter(item => {

        const d = new Date(item.date_sold);
        const y = d.getFullYear();
        const m = String(d.getMonth() + 1).padStart(2, '0');
        return `${y}-${m}` === monthKey;

    })

    return monthAndYear;
  
}


function getTotalQuantity(itemData, productSoldData, categories){

    const productId = itemData.filter(item => item.categories === categories).map(item => item.product_id);
    const productSold = productSoldData.filter(item => productId.includes(item.product_id));

    const totalQuantity = productSold.reduce((sum, item) => {
        return sum + parseFloat(item.quantity)
    }, 0)

    return totalQuantity;
}


function invoiceTable(sales_data){

    const day = new Date().getDate();

    const salesNow = sales_data.filter(item => {
        const itemDay = new Date(item.date_sold).getDate();
        return itemDay === day;
    });

    const table = document.querySelector('table tbody');
    let tableRenderer = "";


    if(salesNow.length === 0){
        table.innerHTML = `<tr><td colspan="6" class="text-center">No sales yet...</td></tr>`
        return;
    }

    salesNow.forEach((item) => {

        tableRenderer+=`
            <tr><td>${item.sale_id}</td>
            <td>${item.total_price}</td>
            <td>${item.amount_paid}</td>
            <td>${item.change_due}</td>
            <td>${item.date_sold}</td></tr>
        `

    })

    table.innerHTML = tableRenderer;

}