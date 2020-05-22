var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    error = document.getElementsByClassName("errorjs").item(0).innerText;
    //console.log(document.getElementsByClassName("errorjs"));
    const err = Swal.mixin({
        Toast: true,
        position: 'top-center',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: false,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    err.fire({
        icon: 'error',
        title: error
    })

    //warning
    warning = document.getElementsByClassName("warningjs").item(0).innerText;
    const warn = Swal.mixin({
        Toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: false,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    warn.fire({
        icon: 'error',
        title: warning
    })
});