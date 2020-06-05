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
        var op_id = document.getElementById('nroorden').value;
        axios.get('/getSaldoOp', {
            params: {
                op_id: op_id
            }
        })

            .then(function (res){
                if (res.status == 200) {
                    inputPesaje = document.getElementById("pesocargado");
                    let tara = document.getElementById("peso").value;
                    let saldo = res.data[0].saldo;

                    // Defino 40000 como el max que carga el camion
                    if (saldo > 40000){
                        saldo = getRandomInt(35000, 40000);
                    }

                    inputPesaje.value = parseInt(tara) + parseInt(saldo);
                }
            })
            .catch(function (err) {
                console.log(err);
            });



    });


})
