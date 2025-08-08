addEventListener('DOMContentLoaded', function(){
    loadData();
})

async function loadData(){

    const adminData = await getAdminData();
    
    adminTable(adminData);

}

async function getAdminData(){

    try{
        const response = await fetch('http://localhost/AG_MAMACLAY_DASHBOARD/backend/adminApi.php');
        const jsondata = await response.json();
        return jsondata['admin_data'];
    }catch(err){
        console.log(err);
    }

}

function adminTable(adminData){
    
    const table = document.querySelector('.admin-tbody');

    let tableRenderer = '';

    adminData.forEach((item) => {
        tableRenderer+=`
            <tr>
                <td>${item.admin_id}</td>
                <td>${item.fname}</td>
                <td>${item.lname}</td>
                <td>${item.admin_email}</td>
                <td>
                    <button>Update</button>
                    <button>Delete</button>
                </td>
            </tr>
        `
    })

    table.innerHTML = tableRenderer;
}