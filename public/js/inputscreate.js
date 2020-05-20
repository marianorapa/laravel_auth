var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //ARCHIVO log in carpeta personas
    //nombres
    validar_nombre = document.querySelector(".nombrepjs");
    validar_nombre.addEventListener("blur", function() {
        var nombre = /^[a-zA-Z]{3,20}$/;
        if (nombre.exec(validar_nombre.value)) {
            validar_nombre.style.background = "#ffffff";
        } else {
            validar_nombre.style.background = "#e05f5f";
        }
    });

    //apellidos
    validar_apellidos = document.querySelector(".apellidosjs");
    validar_apellidos.addEventListener("blur", function() {
        var apellidos = /^[a-zA-Z]{3,20}$/;
        if (apellidos.exec(validar_apellidos.value)) {
            validar_apellidos.style.background = "#ffffff";
        } else {
            validar_apellidos.style.background = "#e05f5f";
        }
    });

    /*
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
    });*/
    //nacimiento
    validar_fecha_nac = document.querySelector(".fechaNacjs");
    validar_fecha_nac.addEventListener("blur", function() {
        var hoy = new Date();
        var mes;
        var meshoy = hoy.getMonth() + 1;
        var diahoy = hoy.getDay();
        if (meshoy < 10) {
            meshoy = '0' + meshoy;
        }
        if (diahoy < 10) {
            diahoy = '0' + diahoy;
        }
        var formato_hoy = (hoy.getFullYear() - 20) + "-" + meshoy + "-" + diahoy;
        if (validar_fecha_nac.value === "") {
            validar_fecha_nac.style.background = "#ffffff";
        } else if (validar_fecha_nac.value > formato_hoy) {
            validar_fecha_nac.style.background = "#e05f5f";
        } else {
            validar_fecha_nac.style.background = "#ffffff";
        }
    });




});