addEventListener('DOMContentLoaded', function(){
    loadData();

    const modal = document.getElementById('add_admin');
    if (modal) {
        modal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('add-admin-form').reset();
            const errorMessages = document.querySelectorAll('.error-message');

            errorMessages.forEach(msg => msg.textContent = '');

            
            const formGroup = document.querySelectorAll('.form-group');
            formGroup.forEach(group => { 
                const input = group.querySelector('input');

                input.classList.remove('error')
            });

        })

    }

})

async function loadData(){

    const adminData = await getAdminData();
    adminTable(adminData);
    formValidation();

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


function formValidation(){

    const saveAdminBtn = document.getElementById('save_admin');

    saveAdminBtn.addEventListener('click', function() {
        
        const formGroup = document.querySelectorAll('.form-group');
        let isValid = true;
    

        formGroup.forEach((group) => {

            const field = group.querySelector('input');
            const errorMessage = group.querySelector('.error-message');

            if(field.value.trim() === ''){
                errorMessage.textContent = `${field.name} is required.`
                field.classList.add('error');
                isValid = false;
            } else {
                errorMessage.textContent = "";
                field.classList.remove('error')
            };
        });

        if(isValid){

            const newPass = document.getElementById('admin_pass').value;
            const reEnterPass = document.getElementById('re-enter');
            const reEnterValue = reEnterPass.value;

            const notMarchError = document.querySelector('.not-match-error');

            if(reEnterValue != newPass){
                notMarchError.textContent = `Password do not matched`
                reEnterPass.classList.add('error');
                return;
            }

            const fname = document.getElementById('admin_fname').value;
            const lname = document.getElementById('admin_lname').value;
            const adminEmail = document.getElementById('admin_email').value;
            
            const newAdminData = {fname, lname, adminEmail, reEnterValue};

            saveNewAdmin(newAdminData)

        }

    })

}

async function saveNewAdmin(newAdminData){

    try{

        const response = await fetch('http://localhost/AG_MAMACLAY_DASHBOARD/backend/adminApi.php', {
            method: "POST",
                headers: {
                "Content-Type": "application/json"
                },
                body: JSON.stringify(newAdminData)
            }); 


        const result = await response.json();

        if(result.success){
            alert('Successfully added a new admin')
            console.log(result)
            
        }else{
            alert('Error please try again')
        }


    }
    catch(err){
        console.log(err)
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