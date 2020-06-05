var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {


    //cliente
    validar_nombre = document.querySelector(".clientejs");
    validar_nombre.addEventListener("blur", function() {
        var nombre = /^[a-zA-Z ]{3,40}$/;
        if (validar_nombre.value == "") {
            validar_nombre.style.background = "#ffffff";
        }
        if (validar_nombre.value !== "") {
            if (nombre.exec(validar_nombre.value)) {
                validar_nombre.style.background = "#ffffff";
            } else {
                validar_nombre.style.background = "#e05f5f";
            }
        }
    });

    //producto
    validar_producto = document.querySelector(".productojs");
    validar_producto.addEventListener("blur", function() {
        var producto = /^[a-zA-Z0-9 ]{3,40}$/;
        if (validar_producto.value == "") {
            validar_producto.style.background = "#ffffff";
        }
        if (validar_producto.value !== "") {
            if (producto.exec(validar_producto.value)) {
                validar_producto.style.background = "#ffffff";
            } else {
                validar_producto.style.background = "#e05f5f";
            }
        }
    });


    //descripcion
    validar_descripcion = document.querySelector(".descripcionjs");
    validar_descripcion.addEventListener("blur", function() {
        var descripcion = /^[a-zA-Z0-9 ]{3,100}$/;
        if (validar_descripcion.value == "") {
            validar_descripcion.style.background = "#ffffff";
        }
        if (validar_descripcion.value !== "") {
            if (descripcion.exec(validar_descripcion.value)) {
                validar_descripcion.style.background = "#ffffff";
            } else {
                validar_descripcion.style.background = "#e05f5f";
            }
        }
    });

    //patente
    validar_patente = document.querySelector(".patentejs");
    validar_patente.addEventListener("blur", function() {
        var patente = /^[a-zA-Z]{3}[0-9]{3}$/;
        var patente2 = /^[a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2}$/;
        if (validar_patente.value == "") {
            validar_patente.style.background = "#ffffff";
        }
        if (validar_patente.value !== "") {
            if (patente.exec(validar_patente.value) || patente2.exec(validar_patente.value)) {
                validar_patente.style.background = "#ffffff";
            } else {
                validar_patente.style.background = "#e05f5f";
            }
        };
    });
});