var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {


    validar_cantidad = document.querySelector(".cantidadjs");
    validar_cantidad.addEventListener("blur", function() {
        var numero = /^[0-9]{2,10}$/;
        if (numero.exec(validar_cantidad.value)) {
            validar_cantidad.style.background = "#ffffff";
        } else {
            validar_cantidad.style.background = "#e05f5f";
        }
    });


    validar_precio = document.querySelector(".preciojs");
    validar_precio.addEventListener("blur", function() {
        var integers = /^(100(\.0{1,2})?|[0-9]?[0-9]|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        if (integers.exec(validar_precio.value)) {
            validar_precio.style.background = "#ffffff";
        } else {
            validar_precio.style.background = "#e05f5f";
        }
    });

    validar_fecha_hasta = document.querySelector(".fecha_entregajs");
    validar_fecha_hasta.addEventListener("blur", function() {
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
        var formato_hoy = hoy.getFullYear() + "-" + meshoy + "-" + diahoy;
        if (validar_fecha_hasta.value === "") {
            validar_fecha_hasta.style.background = "#ffffff";
        } else if (validar_fecha_hasta.value <= formato_hoy) {
            validar_fecha_hasta.style.background = "#e05f5f";
        } else {
            validar_fecha_hasta.style.background = "#ffffff";
        }

    });
});