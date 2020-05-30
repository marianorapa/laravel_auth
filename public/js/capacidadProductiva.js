var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {

    validar_capacidad = document.querySelector(".capacidadjs");
    validar_capacidad.addEventListener("blur", function() {
        var integers = /^(100(\.0{1,9})?|[0-9]?[0-9]|([0-9]{1,8})|([0-9]{1,8}(\.[0-9]{1,2}))|([0-9]?[0-9](\.[0-9]{1,2})))$/;
        if (integers.exec(validar_capacidad.value)) {
            validar_capacidad.style.background = "#ffffff";
        } else {
            validar_capacidad.style.background = "#e05f5f";
        }
    });


    inputFechaHasta = document.getElementById('fecha_hasta');
    inputFechaHasta.disabled = true;
    radioTemporal = document.getElementById('radioTemporal');
    radioTemporal.addEventListener('change', function(){
        inputFechaHasta.disabled = false;
    })

    radioPermanente = document.getElementById('radioPermanente');
    radioPermanente.addEventListener('change', function(){
        inputFechaHasta.disabled = true;
    })

});
