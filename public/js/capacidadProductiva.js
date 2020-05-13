var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    validar_capacidad = document.querySelector(".capacidadjs");
    validar_capacidad.addEventListener("blur", function() {
        var integers = /^(100(\.0{1,2})?|[0-9]?[0-9]|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        if (integers.exec(validar_capacidad.value)) {
            validar_capacidad.style.background = "#ffffff";
        } else {
            validar_capacidad.style.background = "#e05f5f";
        }
    });



});