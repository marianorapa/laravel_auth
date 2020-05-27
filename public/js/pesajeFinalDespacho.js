var window = window || {},
    document = document || {},
    console = console || {};
document.addEventListener("DOMContentLoaded", function() {



    //funcion para generar nro random en un pesaje.
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    btn_pesaje = document.querySelector(".pesajeAleatorio");

    btn_pesaje.addEventListener("click",function () {
        inputPesaje = document.getElementById("pesocargado");
        console.log(inputPesaje)
        inputPesaje.value = getRandomInt(13000,15000);// ajustar este valor.
    });


})
