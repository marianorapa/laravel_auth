var window = window ||{},
document = document ||{},
console = console || {};
document.addEventListener("DOMContentLoaded", function(event)
{
    check_habilitar = document.querySelector(".checknrolote")
    check_habilitar.addEventListener("change", function(){

            if (check_habilitar.checked){

                document.getElementById('nrolote').disabled = true;
                   } else{

                document.getElementById('nrolote').disabled= false;
                   }


    });
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }
    butonPesaje = document.querySelector(".pesajeAleatorio");
    butonPesaje.addEventListener("click",function () {
        inputPesaje = document.getElementById("pesaje");
        inputPesaje.value = getRandomInt(100,1000);
    })



});
