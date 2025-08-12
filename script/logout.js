document.querySelectorAll('.log-out-btn').forEach((btn) => {

    btn.addEventListener('click', function() {

            Swal.fire({
            title: "Are you sure you want to log out?",
            icon: "info",    
            showCancelButton: true,
            confirmButtonColor: " #3085d6",
            cancelButtonColor: " #d33",
            confirmButtonText: "Yes"
        }).then(async (alertResult) => {
            if (alertResult.isConfirmed) {
                
                Swal.fire({
                    title: "Loading...",
                    text: "Please wait",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    
                    window.location.href = 'logout.php';

                }, 5000)


            }
        })
        
    })
})