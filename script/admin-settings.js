addEventListener('DOMContentLoaded', function(){
    loadData();
    loadScript();

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

function loadScript(){
    formValidation();
}

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
            loadData();
            
        }else{
            alert('Error please try again')
        }


    }
    catch(err){
        console.log(err)
    }

}

async function deleteAdmin(){
    

    const table = document.querySelector('.admin-tbody');

    table.addEventListener('click', function(e) {

        const updateBtn = e.target.closest('.update-btn')
        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn) {
            const adminId = deleteBtn.getAttribute('data-adminid');
            console.log(adminId);
        } else if (updateBtn){
            const adminId = updateBtn.getAttribute('data-adminid');
            console.log(`update ${adminId}`);
        }



    })

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
                    <button class="update-btn table-btn" data-adminid="${item.admin_id}"
                    > <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#78A75A"><path d="M560-80v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-300L683-80H560Zm300-263-37-37 37 37ZM620-140h38l121-122-18-19-19-18-122 121v38ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v120h-80v-80H520v-200H240v640h240v80H240Zm280-400Zm241 199-19-18 37 37-18-19Z"/></svg> </button>
                    

                    <button class="delete-btn table-btn" data-adminid="${item.admin_id}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA3323"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg> </button>

                </td>
            </tr>
        `
    })

    table.innerHTML = tableRenderer;
    deleteAdmin();
}