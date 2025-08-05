document.addEventListener('DOMContentLoaded', function() {

    scriptLoad();
    loadData();
})

function scriptLoad(){
    soldByCategoryGraph();
    salesGraph();
}

async function loadData(){
    const product_data = await getProduct();

    const { sales, sales_per_product } = await getSalesAndSalesByProduct();

    console.log("Sales:", sales);
    console.log("Sales per Product:", sales_per_product);

    productCard(product_data);
    saleTodayCard(sales, sales_per_product);
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
}

async function getSalesAndSalesByProduct(){
    try{
        const salesData = await fetch(`http://localhost/AG_MAMACLAY_DASHBOARD/backend/getSale.php`)
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


    console.log(typeof dateNow);

    sales.forEach(element => {

         if(element.date_sold === dateNow){
            console.log("Today's sale:", element);
            todaySales.push(element)
        } 

    });

    console.table(todaySales);
    
    todaysTotalSale = todaySales.reduce((sum, item) => {
        return sum + parseFloat(item.total_price);
    }, 0); 


    const todaySaleId = sales.filter(item => item.date_sold === dateNow).map(item => item.sale_id);
    const sold_per_item = sales_per_product.filter(item => todaySaleId.includes(item.sale_id))

    showTodaySale.textContent = todaysTotalSale;
    showTodayCustomerCount.textContent = todaySales.length;
    showTodaySaleCount.textContent = sold_per_item.length;

    
    
    


}


function soldByCategoryGraph() {
    
    const sbcg = document.getElementById('sold-by-category-graph');

    new Chart(sbcg, {
        type: 'bar',
        data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green'],
        datasets: [{
            label: '# of Votes',
            data: [12,16,11,67],
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


function salesGraph(){

    const salesGraph = document.getElementById("sales_graph");

    const data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
        label: 'Sales',
        data: [1200, 5000, 1800, 12223, 16000, 32444, 28999, 1222, 190, 12888,12344, 12239],
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

    new Chart(salesGraph, config);
}
  
