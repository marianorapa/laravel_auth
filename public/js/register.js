var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //ARCHIVO LOG IN PRIMERA VEZ, PRIMEROS CAMPOS
    //nombres
    validar_nombres = document.querySelector(".nombresjs");
    validar_nombres.addEventListener("blur", function() {
        var nombres = /^[a-z]{3,20}$/;
        if (nombres.exec(validar_nombres.value)) {
            validar_nombres.style.background = "#ffffff";
        } else {
            validar_nombres.style.background = "#e05f5f";
        }
    });

    //password
    validar_password = document.querySelector(".passwordjs");
    validar_password.addEventListener("blur", function() {
        var pass = /^[a-z0-9_-]{6,18}$/;
        if (pass.exec(validar_password.value)) {
            validar_password.style.background = "#ffffff";
        } else {
            validar_password.style.background = "#e05f5f";
        }
    });

    //confirmar password
    validar_confpass = document.querySelector(".confirmarpasswordjs");
    validar_confpass.addEventListener("blur", function() {
        var cpass = /^[a-z0-9_-]{6,18}$/;
        if (cpass.exec(validar_confpass.value) && (validar_confpass.value == validar_password.value)) {
            validar_confpass.style.background = "#ffffff";
        } else {
            validar_confpass.style.background = "#e05f5f";
        }
    });


});