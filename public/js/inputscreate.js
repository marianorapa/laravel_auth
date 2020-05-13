var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //ARCHIVO log in carpeta personas
    //nombres
    validar_nombre = document.querySelector(".nombrepjs");
    validar_nombre.addEventListener("blur", function() {
        var nombre = /^[a-z]{3,20}$/;
        if (nombre.exec(validar_nombre.value)) {
            validar_nombre.style.background = "#ffffff";
        } else {
            validar_nombre.style.background = "#e05f5f";
        }
    });

    //apellidos
    validar_apellidos = document.querySelector(".apellidosjs");
    validar_apellidos.addEventListener("blur", function() {
        var apellidos = /^[a-z]{3,20}$/;
        if (apellidos.exec(validar_apellidos.value)) {
            validar_apellidos.style.background = "#ffffff";
        } else {
            validar_apellidos.style.background = "#e05f5f";
        }
    });

    validar_fechanac = document.querySelector(".fechaNacjs");
    validar_fechanac.addEventListener("blur", function() {
        var hoy = new Date();
        var aniohoy = hoy.getFullYear();
        var year = validar_fechanac.value.substr(0, 4);
        if (year > (aniohoy - 20)) {
            validar_fechanac.style.background = "#e05f5f";
        } else {
            validar_fechanac.style.background = "#ffffff";
        }
    });



});