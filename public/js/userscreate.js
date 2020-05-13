var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //ARCHIVO js para crear y editar usuarios
    //USERNAME
    validar_username = document.querySelector(".usernamejs");
    validar_username.addEventListener("blur", function() {
        var user = /^[a-z-A-Z0-9]{6,20}$/;
        if (user.exec(validar_username.value)) {
            validar_username.style.background = "#ffffff";
        } else {
            validar_username.style.background = "#e05f5f";
        }
    });

    //password
    validar_password = document.querySelector(".passwordjs");
    validar_password.addEventListener("blur", function() {
        var pass = /^[a-zA-Z0-9_-]{6,18}$/;
        if (pass.exec(validar_password.value)) {
            validar_password.style.background = "#ffffff";
        } else {
            validar_password.style.background = "#e05f5f";
        }
    });

    //confirmar password
    validar_confpass = document.querySelector(".confirmarpasswordjs");
    validar_confpass.addEventListener("blur", function() {
        var cpass = /^[a-zA-Z0-9_-]{6,18}$/;
        if (cpass.exec(validar_confpass.value) && (validar_confpass.value == validar_password.value)) {
            validar_confpass.style.background = "#ffffff";
        } else {
            validar_confpass.style.background = "#e05f5f";
        }
    });

    //observacion
    validar_observacion = document.querySelector(".observacionjs");
    validar_observacion.addEventListener("blur", function() {
        var observaciones = /^[a-zA-Z0-9_-]{0,140}$/;
        if (observaciones.exec(validar_observacion.value) && (validar_observacion.value != "")) {
            validar_observacion.style.background = "#ffffff";
        } else {
            validar_observacion.style.background = "#e05f5f";
        }
    });


});