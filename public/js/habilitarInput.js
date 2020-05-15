
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

    //funcion para generar nro random en un pesaje.
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }
    butonPesaje = document.querySelector(".pesajeAleatorio");
    butonPesaje.addEventListener("click",function () {
        inputPesaje = document.getElementById("pesaje");
        inputPesaje.value = getRandomInt(100,1000);
    })

    //evento donde se carga select de insumos de forma dinamica
    selectInsumo = document.querySelector(".selectInsumo");
    proveedor_id = document.querySelector(".selectProveedor");
    check_habilitar.addEventListener("click",function () {
        var id = proveedor_id.value;
        if (check_habilitar.checked){

            axios.get('/insumosasinc',{
                data:{
                    id :id
                }
            })
                .then(function (res) {
                    if (res.status == 200){
                        var i = 0;
                        //console.log(res.data[length]);
                         while (i< res.data['length']){
                             opcion = document.createElement("option");
                             opcion.value=res.data[i]['id'];
                             opcion.text=res.data[i]['descripcion'];
                             console.log(res.data[i]['descripcion']);
                             selectInsumo.appendChild(opcion);
                            i++;
                         }
                    }
                })
                .catch(function (err) {
                    console.log(err);
                });

        }


    } );

});
