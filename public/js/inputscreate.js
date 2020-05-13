var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //ARCHIVO log in carpeta personas
    //nombres
    validar_nombres = document.querySelector(".nombresjs");
    validar_nombres.addEventListener("blur", function() {
        var nombres = /^[a-z]{6,20}$/;
        if (nombres.exec(validar_nombres.value)) {
            validar_nombres.style.background = "#ffffff";
        } else {
            validar_nombres.style.background = "#e05f5f";
        }
    });

    //apellidos
    validar_apellidos = document.querySelector(".apellidosjs");
    validar_apellidos.addEventListener("blur", function() {
        var apellidos = /^[a-z]{6,20}$/;
        if (apellidos.exec(validar_apellidos.value)) {
            validar_apellidos.style.background = "#ffffff";
        } else {
            validar_apellidos.style.background = "#e05f5f";
        }
    });



});