var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    //calles
    validar_calle = document.querySelector(".callejs");
    validar_calle.addEventListener("blur", function() {
        var calle = /^[a-zA-Z1-9 ]+\.?(( |\-)[a-zA-Z0-9]+\.?)*/;
        if (calle.exec(validar_calle.value)) {
            validar_calle.style.background = "#ffffff";
        } else {
            validar_calle.style.background = "#e05f5f";
        }
    });

    //numero calle
    validar_numeroCalle = document.querySelector(".numerojs");
    validar_numeroCalle.addEventListener("blur", function() {
        var numero = /^[0-9]{1,6}$/;
        if (numero.exec(validar_numeroCalle.value)) {
            validar_numeroCalle.style.background = "#ffffff";
        } else {
            validar_numeroCalle.style.background = "#e05f5f";
        }
    });

    //piso
    validar_piso = document.querySelector(".pisojs");
    validar_piso.addEventListener("blur", function() {
        var piso = /^[0-9]{0,6}$/;
        if (piso.exec(validar_piso.value)) {
            validar_piso.style.background = "#ffffff";
        } else {
            validar_piso.style.background = "#e05f5f";
        }
    });

    //depto
    validar_depto = document.querySelector(".dptojs");
    validar_depto.addEventListener("blur", function() {
        var depto = /^[0-9a-zA-Z]{0,6}$/;
        if (depto.exec(validar_depto.value)) {
            validar_depto.style.background = "#ffffff";
        } else {
            validar_depto.style.background = "#e05f5f";
        }
    });



});