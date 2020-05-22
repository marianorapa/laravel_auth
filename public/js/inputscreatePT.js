var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //nro documento
    validar_documento = document.querySelector(".nroDocumentojs");
    validar_documento.addEventListener("blur", function() {
        var documento = /^[0-9]{8,20}$/;
        if (documento.exec(validar_documento.value)) {
            validar_documento.style.background = "#ffffff";
        } else {
            validar_documento.style.background = "#e05f5f";
        }
    });

    //email
    validar_email = document.querySelector(".emailjs");
    validar_email.addEventListener("blur", function() {
        var email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (email.exec(validar_email.value)) {
            validar_email.style.background = "#ffffff";
        } else {
            validar_email.style.background = "#e05f5f";
        }
    });

    //telefono
    validar_telefono = document.querySelector(".teljs");
    validar_telefono.addEventListener("blur", function() {
        var tel = /^[0-9]{8,20}$/;
        if (tel.exec(validar_telefono.value)) {
            validar_telefono.style.background = "#ffffff";
        } else {
            validar_telefono.style.background = "#e05f5f";
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