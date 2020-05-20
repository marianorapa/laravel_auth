var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {
    var a, b, c, d = false;
    validar_kg = document.querySelector(".precioxkg");
    validar_kg.addEventListener("blur", function() {
        var integers = /^(100(\.0{1,2})?|[0-9]?[0-9]|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        if (integers.exec(validar_kg.value)) {
            validar_kg.style.background = "#ffffff";
            a = true;
        } else {
            validar_kg.style.background = "#e05f5f";
            a = false;
        }


    });
    validar_variacion = document.querySelector(".variacion");
    validar_variacion.addEventListener("blur", function() {
        var porcentaje = /^(100(\.0{1,2})?|[0-9]?[0-9]|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        if (porcentaje.exec(validar_variacion.value)) {
            validar_variacion.style.background = "#ffffff";
            b = true;
        } else {
            validar_variacion.style.background = "#e05f5f";
            b = false;
        }
    })


    validar_fecha_desde = document.querySelector(".fecha_desde");
    validar_fecha_desde.addEventListener("blur", function() {
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
        if (validar_fecha_desde.value === "") {
            validar_fecha_desde.style.background = "#ffffff";
        } else if (validar_fecha_desde.value <= formato_hoy) {
            validar_fecha_desde.style.background = "#e05f5f";
        } else {
            validar_fecha_desde.style.background = "#ffffff";
        }

    });

    validar_fecha_hasta = document.querySelector(".fecha_hasta");
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

    /* validar_boton = document.querySelector(".boton");
     validar_boton.addEventListener("mouseover", function () {
         if(!(a && b && c && d)){
             console.log("asdsad");
             validar_boton.disabled = true;
         }else if (a && b && c && d){
             validar_boton.disabled = false;
         }
     })

     validar_tarjeta = document.querySelector(".tarjeta");
     validar_tarjeta.addEventListener("mouseover" ,function () {
         validar_boton.disabled = false;
     })*/

});