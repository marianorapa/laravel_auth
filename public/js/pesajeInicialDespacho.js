var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //producto
    validar_nombre = document.querySelector(".nombrejs");
    validar_nombre.addEventListener("blur", function() {
        var nombre = /^[a-zA-Z]{3,40}$/;
        if (nombre.exec(validar_nombre.value)) {
            validar_nombre.style.background = "#ffffff";
        } else {
            validar_nombre.style.background = "#e05f5f";
        }
    });

    //patente
    validar_patente = document.querySelector(".patentejs");
    validar_patente.addEventListener("blur", function() {
        var patente = /^[a-zA-Z]{3}[0-9]{3}$/;
        var patente2 = /^[a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2}$/;
        if (patente.exec(validar_patente.value) || patente2.exec(validar_patente.value)) {
            validar_patente.style.background = "#ffffff";
        } else {
            validar_patente.style.background = "#e05f5f";
        }
    });

    //tarajs
    validar_tara = document.querySelector(".tarajs");
    validar_tara.addEventListener("blur", function() {
        var integers = /^(100(\.0{1,9})?|[0-9]?[0-9]|([0-9]{1,8})|([0-9]{1,8}(\.[0-9]{1,2}))|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        if (integers.exec(validar_tara.value)) {
            validar_tara.style.background = "#ffffff";
        } else {
            validar_tara.style.background = "#e05f5f";
        }
    });


});