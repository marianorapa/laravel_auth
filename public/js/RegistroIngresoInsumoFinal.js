var window = window ||{},
    document = document ||{},
    console = console || {};
document.addEventListener("DOMContentLoaded", function(event)
{

    //funcion para generar nro random en un pesaje.
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    tara_Pesaje = document.querySelector(".pesajeAleatorio");
    bruto = document.querySelector(".bruto");
    tara_Pesaje.addEventListener("click",function () {
        inputPesaje = document.getElementById("tara");
        var nro_random=getRandomInt(100,1000);
        while (nro_random>bruto.value){
            nro_random=getRandomInt(100,1000);
        }
        inputPesaje.value = nro_random;
    })

});
