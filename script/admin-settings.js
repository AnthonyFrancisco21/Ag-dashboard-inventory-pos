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
    tableEventDelegation();
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
    const updateBtn = document.getElementById('update_admin');

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

    updateBtn.addEventListener('click', function () {

        const formGroup = document.querySelectorAll('.update-form-group');
        let isValid = true;

        // validate required fields except passwords
        formGroup.forEach((group) => {
            const field = group.querySelector('input');
            const errorMessage = group.querySelector('.error-message');

            if (field.id !== 'update_admin-new-password' && field.id !== 'admin_old_pass') {
                // Non-password fields are always required
                if (field.value.trim() === '') {
                    errorMessage.textContent = `${field.name} is required.`;
                    field.classList.add('error');
                    isValid = false;
                } else {
                    errorMessage.textContent = "";
                    field.classList.remove('error');
                }
            }
        });

        
        const oldPassField = document.getElementById('admin_old_pass');
        const newPassField = document.getElementById('update_admin-new-password');
        const oldPassError = oldPassField.closest('.update-form-group').querySelector('.error-message');
        const newPassError = newPassField.closest('.update-form-group').querySelector('.error-message');

        // If one password field is filled, both are required
        if (oldPassField.value.trim() !== '' || newPassField.value.trim() !== '') {
            if (oldPassField.value.trim() === '') {
                oldPassError.textContent = "Old password is required.";
                oldPassField.classList.add('error');
                isValid = false;
            } else {
                oldPassError.textContent = "";
                oldPassField.classList.remove('error');
            }

            if (newPassField.value.trim() === '') {
                newPassError.textContent = "New password is required.";
                newPassField.classList.add('error');
                isValid = false;
            } else {
                newPassError.textContent = "";
                newPassField.classList.remove('error');
            }
        } else {
            // Clear any old messages if no password change is attempted
            oldPassError.textContent = "";
            oldPassField.classList.remove('error');
            newPassError.textContent = "";
            newPassField.classList.remove('error');
        }

        if (isValid) {
            const admin_new_password = newPassField.value;
            const admin_old_password = oldPassField.value;
            const admin_fname = document.getElementById('update_admin_fname').value;
            const admin_lname = document.getElementById('update_admin_lname').value;
            const admin_email = document.getElementById('update_admin_email').value;

            const updateAdminData = {
                selectedAdminId,
                admin_fname,
                admin_lname,
                admin_email,
                admin_old_password: admin_old_password || "",
                admin_new_password: admin_new_password || ""
            };

            
            console.log(`Grab new data`, updateAdminData);
            updateAdmin(updateAdminData);
        }
    });

}

async function updateAdmin(updateAdminData){

    Swal.fire({
        title: "Update this admin?",
        text: "Are you sure you want to update this admin?",
        icon: "warning",    
        showCancelButton: true,
        confirmButtonColor: " #3085d6",
        cancelButtonColor: " #d33",
        confirmButtonText: "Yes, update it!"
    }).then(async (alertResult) => {
        if (alertResult.isConfirmed) {
            
            Swal.fire({
                title: "Updating...",
                text: "Please wait",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

             try{
                const response = await fetch('http://localhost/AG_MAMACLAY_DASHBOARD/backend/updateAdmin.php', {
                    method: 'POST',
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(updateAdminData)
                    })

                const result = await response.json();

                if(result.success){
                    setTimeout(() => {

                        Swal.close(); 
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: `${result.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        loadData();
                        //Hide the modal--
                        const modal = bootstrap.Modal.getInstance(document.getElementById('update_ad_modal'));
                        if (modal) modal.hide()
                        document.getElementById('admin_old_pass').value = '';
                        document.getElementById('update_admin-new-password').value = '';

                    }, 3000)

                }else{
                    Swal.close(); 
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: `${result.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }

            }catch(error){
                Swal.close(); 
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: `${error}`,
                    showConfirmButton: false,
                    timer: 3000
                });
            }

        }//isConfirmed end
    }) //alertResult end

}


async function saveNewAdmin(newAdminData){

     Swal.fire({
        title: "Deleting...",
        text: "Please wait",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

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
            Swal.close(); 
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: `${result.message}`,
                showConfirmButton: false,
                timer: 3000
            });
            loadData();
            
            const modalEl = document.getElementById('add_admin');
            if (modalEl) {
                const bsModal = bootstrap.Modal.getInstance(modalEl);
                if (bsModal) {
                    bsModal.hide();
                }
            }
                        
        }else{
            Swal.close(); 
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: `${result.message}`,
                showConfirmButton: false,
                timer: 5000
            });

        }


    }
    catch(err){
        Swal.close(); 
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: `Admin is already exist!`,
            showConfirmButton: false,
            timer: 5000
        });
    }

}

let selectedAdminId = null;

async function tableEventDelegation(){
    
    const table = document.querySelector('.admin-tbody');

    table.addEventListener('click', function(e) {

        const updateBtn = e.target.closest('.update-btn');
        const deleteBtn = e.target.closest('.delete-btn');
        if (deleteBtn) {
            const adminId = deleteBtn.getAttribute('data-adminid');
            deleteAdmin(adminId);
        } else if (updateBtn){
            selectedAdminId = updateBtn.dataset.adminid;
            
            document.getElementById('update_admin_fname').value = updateBtn.dataset.fname;
            document.getElementById('update_admin_lname').value = updateBtn.dataset.lname;
            document.getElementById('update_admin_email').value = updateBtn.dataset.email;

        }

    })

}

async function deleteAdmin(adminId){

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",    
        showCancelButton: true,
        confirmButtonColor: " #d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then(async (alertResult) => {
        if (alertResult.isConfirmed) {
            
            Swal.fire({
                title: "Deleting...",
                text: "Please wait",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            const action = 'delete'
            const isDeleted = '1'
            const adminIdData = {action,adminId, isDeleted}
          
        try {
            
            const response = await fetch('http://localhost/AG_MAMACLAY_DASHBOARD/backend/adminApi.php', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(adminIdData)
            })
            
            const result = await response.json();
            console.log(result);

            if(result.success){
                setTimeout(() => {
                    Swal.close(); 
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Deleted Successfully'
                    });

                    loadData();
                }, 2000)
                
            }
            else{
                
                Swal.close(); 
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Unable to delete the admin.',
                    showConfirmButton: false,
                    timer: 5000
                });

            }

        } catch (err) {
            Swal.close(); 
            Swal.fire({
                title: "Error!",
                text: "Please try again later or refresh the page.",
                icon: "error",
                showConfirmButton: false,
                timer: 5000
            });
        }
            
        };
    });   

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
                    <button class="update-btn table-btn" data-bs-toggle="modal" data-bs-target="#update_ad_modal" 
                    data-adminid="${item.admin_id}"
                    data-fname="${item.fname}"
                    data-lname="${item.lname}"
                    data-email="${item.admin_email}"
                    > <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#78A75A"><path d="M560-80v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-300L683-80H560Zm300-263-37-37 37 37ZM620-140h38l121-122-18-19-19-18-122 121v38ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v120h-80v-80H520v-200H240v640h240v80H240Zm280-400Zm241 199-19-18 37 37-18-19Z"/></svg> </button>
                    

                    <button class="delete-btn table-btn" data-adminid="${item.admin_id}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA3323"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg> </button>

                </td>
            </tr>
        `
    })

    table.innerHTML = tableRenderer;
}