var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //js para crear y editar roles
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

    //observacion
    validar_observacion = document.querySelector(".observacionjs");
    validar_observacion.addEventListener("blur", function() {
        if (validar_observacion.value.length < 100) {
            validar_observacion.style.background = "#ffffff";
        } else {
            validar_observacion.style.background = "#e05f5f";
        }
    });

});