var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //nro lote
    validar_lote = document.querySelector(".lotejs");
    validar_lote.addEventListener("blur", function() {
        var numero = /^[0-9]{3,15}$/;
        if (numero.exec(validar_lote.value)) {
            validar_lote.style.background = "#ffffff";
        } else {
            validar_lote.style.background = "#e05f5f";
        }
    });

    //elaboracion
    validar_fecha_elab = document.querySelector(".elaboracionjs");
    validar_fecha_elab.addEventListener("blur", function() {
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
        if (validar_fecha_elab.value === "") {
            validar_fecha_elab.style.background = "#ffffff";
        } else if (validar_fecha_elab.value > formato_hoy) {
            validar_fecha_elab.style.background = "#e05f5f";
        } else {
            validar_fecha_elab.style.background = "#ffffff";
        }

        window.sessionStorage.setItem("fecha_elaboracion",this.value);
    });

    //vencimiento
    validar_fecha_vencimiento = document.querySelector(".vencimientojs");
    validar_fecha_vencimiento.addEventListener("blur", function() {
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
        if (validar_fecha_vencimiento.value === "") {
            validar_fecha_vencimiento.style.background = "#ffffff";
        } else if (validar_fecha_vencimiento.value <= formato_hoy) {
            validar_fecha_vencimiento.style.background = "#e05f5f";
        } else {
            validar_fecha_vencimiento.style.background = "#ffffff";
        }
        window.sessionStorage.setItem("fecha_vencimiento",this.value);
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


    //carta porte
    validar_porte = document.querySelector(".cartajs");
    validar_porte.addEventListener("blur", function() {
        var numero = /^[0-9]{4,12}$/;
        if (validar_porte.value != ""){
            if (numero.exec(validar_porte.value)) {
                validar_porte.style.background = "#ffffff";
            } else {
                validar_porte.style.background = "#e05f5f";
            }
        }

    });

    //pesojs
    validar_peso = document.querySelector(".pesojs");
    validar_peso.addEventListener("blur", function() {
        /*var integers = /^(100(\.0{1,9})?|[0-9]?[0-9]|([0-9]{1,8})|([0-9]{1,8}(\.[0-9]{1,2}))|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        if (integers.exec(validar_peso.value)) {
            validar_peso.style.background = "#ffffff";
        } else {
            validar_peso.style.background = "#e05f5f";
        }*/
    });

// CODIGO PARA GUARDAR DATOS DE FECHAS.


});
