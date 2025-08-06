document.addEventListener('DOMContentLoaded', function() {

    scriptLoad();
    loadData();
})

function scriptLoad(){
    
    salesGraph();
}

async function loadData(){
    const product_data = await getProduct();

    const { sales, sales_per_product } = await getSalesAndSalesByProduct();

    console.log("Sales:", sales);
    console.log("Sales per Product:", sales_per_product);

    productCard(product_data);
    saleTodayCard(sales, sales_per_product);
    soldByCategoryGraph(product_data, sales_per_product)
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


function soldByCategoryGraph(itemData, productSoldData) {
    
    /* console.table(itemData);
    console.table(productSoldData); */

   /*  const productIdFeeds = itemData.filter(item => item.categories === 'feeds').map(item => item.product_id);
    const productSoldFeeds = productSoldData.filter(item => productIdFeeds.includes(item.product_id));


    const feedsQuantity = productSoldFeeds.reduce((sum, item) => {
        return sum + parseFloat(item.quantity)
    }, 0)
 */

    const feedsQuantity = getTotalQuantity(itemData, productSoldData, 'feeds');
    const supplementsQuantity = getTotalQuantity(itemData, productSoldData, 'Supplements');
    const equipmentsQuantity = getTotalQuantity(itemData, productSoldData, 'Equipment');
    const accessoriesQuantity = getTotalQuantity(itemData, productSoldData, 'Accessories');
    const othersQuantity = getTotalQuantity(itemData, productSoldData, 'others');


    const sbcg = document.getElementById('sold-by-category-graph');

    new Chart(sbcg, {
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

function getTotalQuantity(itemData, productSoldData, categories){

    const productId = itemData.filter(item => item.categories === categories).map(item => item.product_id);
    const productSold = productSoldData.filter(item => productId.includes(item.product_id));

    const totalQuantity = productSold.reduce((sum, item) => {
        return sum + parseFloat(item.quantity)
    }, 0)

    return totalQuantity;
}


function salesGraph(){

    const salesGraph = document.getElementById("sales_graph");

    const data = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
        label: 'Sales',
        data: [0, 0, 0, 0, 0, 0, 0, 1222, 0, 0,0, 0],
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
  
